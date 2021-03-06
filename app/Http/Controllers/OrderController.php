<?php

namespace App\Http\Controllers;

use App\HotelReservation;
use App\Http\Requests\HotelReservationStoreRequest;
use App\Order;
use App\Payment;
use App\Service;
use App\Agent;
use App\Hotel;
use App\User;
use App\Provider;
use App\Tourist;
use App\Requisite;
use App\PaymentStatus;
use App\HotelStatus;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return OrderResource::collection(
            Order::orderBy('created_at', 'desc')->paginate(config('resources.items_per_page'))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderStoreRequest $request
     * @return Response
     * @throws \Exception
     */
    public function store(OrderStoreRequest $request)
    {
        $order = new Order([
            'account_number'    => $request->get('account_number'),
            'sum'               => $request->get('sum'),
            'commission'        => $request->get('commission'),
        ]);

        DB::beginTransaction();

        try {
            $order->save();

            $client = User::findOrFail($request->get('client_id'));
            $order->client()->associate($client);

            $manager = User::findOrFail($request->get('manager_id'));
            $order->manager()->associate($manager);

            $provider = Provider::findOrFail($request->get('provider_id'));
            $order->provider()->associate($provider);

            $tourists = $request->get('tourist_ids');
            $order->tourists()->attach($tourists);

            $payments = $request->get('payments');
            foreach ($payments as $payment) {
                if (is_array($payment)) {
                    $order->payments()->save(new Payment([
                        'sum' => $payment['sum'],
                        'payment_type' => $payment['payment_type'],
                        'comment' => $payment['comment']
                    ]));
                } elseif (is_int($payment)) {
                    $paymentObject = Payment::findOrFail($payment);
                    $order->payments()->save($paymentObject);
                }
            }

            $reservations = $request->get('hotel_reservations');
            foreach ($reservations as $reservation) {
                if (is_int($reservation)) {
                    $reservation = HotelReservation::findOrFail($reservation);
                    $order->hotelReservations()->save($reservation);
                } elseif (is_array($reservation)) {
                    $hotelReservation = HotelReservation::storeData(new HotelReservationStoreRequest($reservation));
                    $order->hotelReservations()->save($hotelReservation);
                }
            }

            $order->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        return response()->json([
            'message' => __('responses.order.stored'),
            'response' => new OrderResource($order),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
