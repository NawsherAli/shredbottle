<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;

class NewsletterSubscriptionController extends Controller
{

    /**
     * Subscribe a new email to the newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email'
        ]);

        $subscription = NewsletterSubscription::create([
            'email' => $request->email
        ]);

        // Return success response
        return response()->json(['message' => 'Subscription successful'], 201);
    }

    /**
     * Unsubscribe an email from the newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsubscribe(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|exists:newsletter_subscriptions,email'
        ]);

        // Find the subscription by email and delete it
        NewsletterSubscription::where('email', $request->email)->delete();

        // Return success response
        return response()->json(['message' => 'Unsubscription successful'], 200);
    }
}
