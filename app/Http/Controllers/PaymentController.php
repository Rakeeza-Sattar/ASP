<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SquarePaymentService;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\SendPaymentConfirmationEmail;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $squareService;

    public function __construct(SquarePaymentService $squareService)
    {
        $this->squareService = $squareService;
    }

    /**
     * Show payment form
     */
    public function showPaymentForm($appointmentId = null)
    {
        $amount = 50.00; // Service fee
        $subscriptionAmount = 29.99; // Monthly subscription
        
        return view('payment.form', compact('amount', 'subscriptionAmount', 'appointmentId'));
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'source_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'payment_type' => 'required|in:one-time,subscription',
            'appointment_id' => 'nullable|exists:appointments,id'
        ]);
        $user = Auth::user();
        // $user = auth()->user();
        $idempotencyKey = Str::uuid()->toString();

        try {
            if ($request->payment_type === 'one-time') {
                $result = $this->squareService->createPayment(
                    $request->amount,
                    $request->source_id,
                    $idempotencyKey
                );
            } else {
                // For subscription, you need to create a catalog item first
                $result = $this->handleSubscription($request, $user, $idempotencyKey);
            }

            if ($result['success']) {
                // Save payment to database
                $payment = Payment::create([
                    'user_id' => $user->id,
                    'square_payment_id' => $result['payment']->getId(),
                    'amount' => $request->amount,
                    'currency' => 'USD',
                    'status' => $result['payment']->getStatus(),
                    'payment_type' => $request->payment_type,
                    'appointment_id' => $request->appointment_id,
                    'receipt_url' => $result['payment']->getReceiptUrl()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment processed successfully!',
                    'payment_id' => $payment->id,
                    'receipt_url' => $result['payment']->getReceiptUrl()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Payment failed',
                'errors' => $result['errors'] ?? [$result['error']]
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle subscription payment
     */
    private function handleSubscription($request, $user, $idempotencyKey)
    {
        // First create or get customer
        $customerResult = $this->squareService->createCustomer(
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->phone
        );

        if (!$customerResult['success']) {
            return $customerResult;
        }

        // Create subscription (you need to have a catalog subscription plan created)
        return $this->squareService->createSubscription(
            'YOUR_SUBSCRIPTION_PLAN_ID', // Create this in Square Dashboard
            $customerResult['customer']->getId(),
            $idempotencyKey
        );
    }

    /**
     * Handle webhook from Square
     */
    public function webhook(Request $request)
    {
        $signatureKey = config('square.webhook_signature_key');
        $body = $request->getContent();
        $signature = $request->header('x-square-signature');

        // Verify webhook signature
        if (!$this->verifyWebhookSignature($body, $signature, $signatureKey)) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $event = json_decode($body, true);

        switch ($event['type']) {
            case 'payment.updated':
                $this->handlePaymentUpdated($event['data']['object']['payment']);
                break;
                
            case 'subscription.updated':
                $this->handleSubscriptionUpdated($event['data']['object']['subscription']);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Verify webhook signature
     */
    private function verifyWebhookSignature($body, $signature, $signatureKey)
    {
        $expectedSignature = base64_encode(hash_hmac('sha256', $body, $signatureKey, true));
        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Handle payment updated webhook
     */
    private function handlePaymentUpdated($paymentData)
    {
        $payment = Payment::where('square_payment_id', $paymentData['id'])->first();
        
        if ($payment) {
            $payment->update([
                'status' => $paymentData['status']
            ]);

            // Send confirmation email if completed
            if ($paymentData['status'] === 'COMPLETED') {
                // Dispatch email job
                SendPaymentConfirmationEmail::dispatch($payment);
            }
        }
    }

    /**
     * Handle subscription updated webhook
     */
    private function handleSubscriptionUpdated($subscriptionData)
    {
        $payment = Payment::where('square_subscription_id', $subscriptionData['id'])->first();
        
        if ($payment) {
            $payment->update([
                'status' => $subscriptionData['status']
            ]);
        }
    }

    /**
     * Get payment history
     */
    public function getPaymentHistory()
    {
        $payments = Payment::where('user_id', auth()->id())
            ->with(['appointment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('payment.history', compact('payments'));
    }
}