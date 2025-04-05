<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;

class SubscriptionController extends Controller
{

    /**
     * @param Request $request
     * @return Checkout
     * @throws Exception
     */
    public function show(Request $request): Checkout
    {
        $user = $request->user();

        return $user->newSubscription('premium', 'price_1R9sq82LwbZxqF7dlUOS8LqA')
            ->checkout([
                'success_url' => route('dashboard') . '?checkout=success',
                'cancel_url' => route('dashboard') . '?checkout=cancel',
            ]);
    }
}

