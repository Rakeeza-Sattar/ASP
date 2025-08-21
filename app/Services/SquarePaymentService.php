<?php

namespace App\Services;

use Square\SquareClient;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;
use Square\Environment;
use Square\Models\CreateSubscriptionRequest;
use Square\Models\Subscription;
use Exception;

class SquarePaymentService
{
    private $client;
    private $locationId;

    public function __construct()
    {
        $environment = config('square.environment') === 'production' 
            ? Environment::PRODUCTION 
            : Environment::SANDBOX;

        $this->client = new SquareClient([
            'accessToken' => config('square.access_token'),
            'environment' => $environment,
            'customUrl' => '',
        ]);

        $this->locationId = config('square.location_id');
    }

    /**
     * Create a one-time payment
     */
    public function createPayment($amount, $sourceId, $idempotencyKey, $orderId = null)
    {
        try {
            $money = new Money();
            $money->setAmount($amount * 100); // Convert to cents
            $money->setCurrency('USD');

            $createPaymentRequest = new CreatePaymentRequest($sourceId, $idempotencyKey);
            $createPaymentRequest->setAmountMoney($money);
            $createPaymentRequest->setLocationId($this->locationId);
            
            if ($orderId) {
                $createPaymentRequest->setOrderId($orderId);
            }

            $api = $this->client->getPaymentsApi();
            $response = $api->createPayment($createPaymentRequest);

            if ($response->isSuccess()) {
                return [
                    'success' => true,
                    'payment' => $response->getResult()->getPayment(),
                    'data' => $response->getResult()
                ];
            }

            return [
                'success' => false,
                'errors' => $response->getErrors()
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create a subscription
     */
    public function createSubscription($planId, $customerId, $idempotencyKey, $startDate = null)
    {
        try {
            $subscription = new Subscription();
            $subscription->setLocationId($this->locationId);
            $subscription->setPlanId($planId);
            $subscription->setCustomerId($customerId);
            
            if ($startDate) {
                $subscription->setStartDate($startDate);
            }

            $request = new CreateSubscriptionRequest($subscription);
            $request->setIdempotencyKey($idempotencyKey);

            $api = $this->client->getSubscriptionsApi();
            $response = $api->createSubscription($request);

            if ($response->isSuccess()) {
                return [
                    'success' => true,
                    'subscription' => $response->getResult()->getSubscription(),
                    'data' => $response->getResult()
                ];
            }

            return [
                'success' => false,
                'errors' => $response->getErrors()
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get payment by ID
     */
    public function getPayment($paymentId)
    {
        try {
            $api = $this->client->getPaymentsApi();
            $response = $api->getPayment($paymentId);

            if ($response->isSuccess()) {
                return [
                    'success' => true,
                    'payment' => $response->getResult()->getPayment()
                ];
            }

            return [
                'success' => false,
                'errors' => $response->getErrors()
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create customer
     */
    public function createCustomer($givenName, $familyName, $emailAddress, $phoneNumber = null)
    {
        try {
            $createCustomerRequest = new \Square\Models\CreateCustomerRequest();
            $createCustomerRequest->setGivenName($givenName);
            $createCustomerRequest->setFamilyName($familyName);
            $createCustomerRequest->setEmailAddress($emailAddress);
            
            if ($phoneNumber) {
                $createCustomerRequest->setPhoneNumber($phoneNumber);
            }

            $api = $this->client->getCustomersApi();
            $response = $api->createCustomer($createCustomerRequest);

            if ($response->isSuccess()) {
                return [
                    'success' => true,
                    'customer' => $response->getResult()->getCustomer()
                ];
            }

            return [
                'success' => false,
                'errors' => $response->getErrors()
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}