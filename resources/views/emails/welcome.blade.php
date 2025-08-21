<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Alpha Security Bureau</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #007bff; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .checklist { background: white; padding: 15px; border-left: 4px solid #28a745; }
        .footer { text-align: center; padding: 20px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Alpha Security Bureau</h1>
            <p>Asset Protection Plan Confirmation</p>
        </div>
        
        <div class="content">
            <h2>Hi {{ $user->first_name }},</h2>
            
            <p>Thank you for enrolling in the Alpha Security Bureau Asset Protection Plan. Your appointment is scheduled for:</p>
            
            <div style="background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <strong>Date & Time:</strong> {{ $appointment->scheduled_at->format('l, F j, Y \a\t g:i A') }}<br>
                <strong>Address:</strong> {{ $appointment->home->full_address }}
            </div>
            
            <div class="checklist">
                <h3>✅ Here's what to have ready:</h3>
                <ul>
                    <li>Receipts for valuables (electronics, jewelry, furniture, etc.)</li>
                    <li>Items to be photographed</li>
                    <li>Any additional documents (appraisals, warranties)</li>
                </ul>
            </div>
            
            <p>Your licensed officer will arrive with proper ID and complete your audit.</p>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ route('login') }}" style="background: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px;">
                    Access Your Account
                </a>
            </p>
            
            <p><strong>Need to reschedule?</strong> Contact us at (555) 123-4567</p>
        </div>
        
        <div class="footer">
            <p>— Alpha Security Bureau<br>
            Protecting Your Assets, Securing Your Future</p>
        </div>
    </div>
</body>
</html>
