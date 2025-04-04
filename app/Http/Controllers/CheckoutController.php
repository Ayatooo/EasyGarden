<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Request $request, string $plan = 'price_1R9sq82LwbZxqF7dlUOS8LqA')
    {
        return $request->user()
            ->newSubscription('default', $plan)
            ->checkout([
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);
    }

    public function success()
    {
        return redirect()->route('dashboard')->with('success', 'Votre abonnement a été activé avec succès !');
    }

    public function cancel()
    {
        return redirect()->route('dashboard')->with('error', 'Le processus d\'abonnement a été annulé.');
    }
}
