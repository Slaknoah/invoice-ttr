<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Http\Resources\PaymentResource;
use App\Payment;

class PaymentController extends Controller
{
    public function index() {
        return PaymentResource::collection(Payment::orderBy('created_at', 'desc')->paginate(config('resources.items_per_page')));
    }

    public function store(PaymentStoreRequest $request) {
        $payment = new Payment([
            'order_id' => $request->get('order_id'),
            'sum' => $request->get('sum'),
            'payment_type' => $request->get('payment_type') ?? 'debit'
        ]);
        $payment->save();

        return response()->json([
            'data' => $payment
        ]);
    }
}
