<?php

namespace App\Http\Controllers;

use App\HotelReservation;
use App\Http\Requests\HotelReservationStoreRequest;
use App\Http\Resources\HotelReservationResource;
use App\Search\HotelReservationSearch;
use Exception;
use Illuminate\Http\Request;

class HotelReservationController extends Controller
{
    public function index(Request $request) {
        $hotelReservationSearch = new HotelReservationSearch;
        return HotelReservationResource::collection($hotelReservationSearch->apply($request));
    }

    public function show(HotelReservation $hotelReservation) {
        return new HotelReservationResource($hotelReservation);
    }

    public function store(HotelReservationStoreRequest $request) {
        $hotelReservation = new HotelReservation([
           'price'          => $request->get('price'),
           'discount'       => $request->get('discount'),
           'date_start'     => $request->get('date_start'),
           'date_end'       => $request->get('date_end'),
           'accommodation'  => $request->get('accommodation')
        ]);

        $hotelReservation->hotel()->associate($request->get('hotel_id'));

        $hotelReservation->hotelStatus()->associate($request->get('hotel_status_id'));

        $hotelReservation->save();

        return response()->json([
            'message'   => __('responses.hotelReservation.stored'),
            'response'  => new HotelReservationResource($hotelReservation)
        ]);
    }

    public function update(Request $request, HotelReservation $hotelReservation) {
        $request->validate([
            'hotel_id'          => 'required|integer',
            'date_start'        => 'nullable|date_format:' . config('app.date_format'),
            'date_end'          => 'nullable|date_format:' . config('app.date_format'),
            'price'             => 'required|numeric',
            'discount'          => 'nullable|numeric',
            'hotel_status_id'   => 'required|integer',
            'accommodation'     => 'required|string'
        ]);

        $hotelReservation->price        = $request->get('price');
        $hotelReservation->discount     = $request->get('discount');
        $hotelReservation->date_start   = $request->get('date_start');
        $hotelReservation->date_end     = $request->get('date_end');
        $hotelReservation->accommodation= $request->get('accommodation');

        $hotelReservation->hotel()->associate($request->get('hotel_id'));

        $hotelReservation->hotelStatus()->associate($request->get('hotel_status_id'));

        $hotelReservation->save();

        return response()->json([
            'message'   =>  __('responses.hotelReservation.updated'),
            'response'  => new HotelReservationResource($hotelReservation)
        ]);
    }

    public function destroy(HotelReservation $hotelReservation) {
        try {
            $hotelReservation->delete();
        } catch (Exception $e) {
            abort($e->getCode(), __('responses.hotelReservation.deleted'));
        }

        return response()->json(['message' => __('responses.hotelReservation.destroyed')], 200);
    }
}
