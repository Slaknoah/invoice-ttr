<?php

namespace App\Http\Controllers;

use App\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_statuses = PaymentStatus::all();
        return view('settings.payment_statuses.index', compact('payment_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_status_name'  => 'required'
        ]);

        $payment_status = new PaymentStatus([
            'name' => $request->get('payment_status_name'),
            'notification' => $request->get('notification'),
            'days' => $request->get('days')
        ]);
        $payment_status->save();
        return redirect()->back()->with('success', 'Статус платежа "'.$payment_status->name.'" добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentStatus $paymentStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_status = PaymentStatus::find($id);
        return view('settings.payment_statuses.edit', compact('payment_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_status_name'  => 'required'
        ]);

        $payment_status = PaymentStatus::find($id);
        $payment_status->name = $request->get('payment_status_name');
        $payment_status->notification = $request->get('notification');
        $payment_status->days = $request->get('days');
        $payment_status->save();
        return redirect('/payment_statuses')->with('success', 'Статус платежа "'.$payment_status->name.'" обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_status = PaymentStatus::find($id);
        $payment_name = $payment_status->name;
        $payment_status->delete();

        return redirect()->back()->with('success', 'Статус платежа "'.$payment_name.'" удален!');
    }
}
