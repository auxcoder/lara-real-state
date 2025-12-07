<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    /**
     * Sends a test email to verify SMTP configuration.
     */
    public function sendTestEmail()
    {
        $recipient = 'auxcoder@gmail.com';

        try {
            Mail::raw('This is a test email from Property Marketplace. If you received this, your SMTP configuration is working correctly!', function ($message) use ($recipient) {
                $message->to($recipient)
                    ->subject('SMTP Test Email - Property Marketplace');
            });

            return response()->json([
                'success' => true,
                'message' => "Test email sent successfully! Check your inbox at {$recipient}",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: '.$e->getMessage(),
            ], 500);
        }
    }
}
