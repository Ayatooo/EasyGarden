<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Subscription;

class StripeWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = $request->all();
        $eventType = $payload['type'] ?? null;

        if ($eventType === 'checkout.session.completed') {
            Log::info('✅ Webhook Stripe : checkout.session.completed bien reçu');

            $session = $payload['data']['object'] ?? null;

            if ($session && isset($session['customer_details']['email'], $session['customer'], $session['subscription'])) {
                $user = User::where('email', $session['customer_details']['email'])->first();

                if ($user) {
                    Log::info('👤 Utilisateur trouvé : ' . $user->email);

                    $user->update([
                        'stripe_id' => $session['customer'],
                    ]);

                    Subscription::create([
                        'type' => 'premium',
                        'user_id' => $user->id,
                        'stripe_id' => $session['subscription'],
                        'stripe_status' => 'active',
                        'stripe_price' => 'price_1R9sq82LwbZxqF7dlUOS8LqA',
                        'quantity' => 1,
                        'ends_at' => now()->addMonth(),
                    ]);

                    Log::info('📦 Abonnement enregistré pour : ' . $user->email);
                } else {
                    Log::warning('❌ Utilisateur non trouvé pour l\'email : ' . $session['customer_details']['email']);
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
