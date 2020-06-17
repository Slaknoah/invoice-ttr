<?php

namespace App\Http\Controllers;

use App\HotelReservation;
use App\Http\Resources\HotelReservationResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HotelReservationController extends Controller
{
    public function index() {
        return HotelReservationResource::collection(
            HotelReservation::orderBy('created_at', 'desc')->paginate(config('resources.items_per_page'))
        );
    }

    public function show(HotelReservation $hotelReservation) {
        return new HotelReservationResource($hotelReservation);
    }

    public function store(Request $request) {
        $request->validate([
            'hotel_id'      => 'required|integer',
            'date_start'    => 'nullable|string',
            'date_end'      => 'nullable|string',
            'price'         => 'required|numeric',
            'discount'      => 'nullable|numeric',
            'status_id'     => 'required|integer',
            'accommodation' => 'required|string'
        ]);

        $date_start = $request->get('date_start');
        $date_end   = $request->get('date_end');
        $reservation = new HotelReservation([
           'price'          => $request->get('price'),
           'discount'       => $request->get('discount'),
           'date_start'     => $date_start ? Carbon::parse($date_start) : null,
           'date_end'       => $date_end ? Carbon::parse($date_end) : null,
           'accommodation'  => $request->get('accommodation')
        ]);

        $reservation->hotel()->associate($request->get('hotel_id'));

        $reservation->hotelStatus()->associate($request->get('status_id'));

        $reservation->save();

        return response()->json([
            'message'   => __('responses.hotelReservation.stored'),
            'response'  => new HotelReservationResource($reservation)
        ]);
    }

    public function update(Request $request, HotelReservation $hotelReservation) {
        $request->validate([
            'hotel_id'      => 'required|integer',
            'date_start'    => 'nullable|string',
            'date_end'      => 'nullable|string',
            'price'         => 'required|numeric',
            'discount'      => 'nullable|numeric',
            'status_id'     => 'required|integer',
            'accommodation' => 'required|string'
        ]);

        $date_start = $request->get('date_start');
        $date_end   = $request->get('date_end');
        $hotelReservation->price        = $request->get('price');
        $hotelReservation->discount     = $request->get('discount');
        $hotelReservation->date_start   = $date_start ? Carbon::parse($date_start) : null;
        $hotelReservation->date_end     = $date_end ? Carbon::parse($date_end) : null;
        $hotelReservation->accommodation= $request->get('accommodation');

        $hotelReservation->hotel()->associate($request->get('hotel_id'));

        $hotelReservation->hotelStatus()->associate($request->get('status_id'));

        $hotelReservation->save();

        return response()->json([
            'message'   =>  __('responses.hotelReservation.updated'),
            'response'  => new HotelReservationResource($hotelReservation)
        ]);
    }

    public function destroy(HotelReservation $hotelReservation) {
        $hotelReservation->delete();

        return response()->json(['message' => __('responses.hotelReservation.destroyed')], 200);
    }
}
