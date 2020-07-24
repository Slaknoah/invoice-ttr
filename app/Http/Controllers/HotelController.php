<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Search\HotelSearch;
use Illuminate\Http\Request;
use App\Http\Resources\HotelResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $hotelSearch = new HotelSearch();
        return HotelResource::collection($hotelSearch->apply($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_name'  => 'required',
            'accommodations' => 'nullable|array',
        ]);

        $hotel = new Hotel([
            'name' => $request->get('hotel_name'),
            'accommodations' => $request->get('accommodations')
        ]);
        $hotel->save();

        return response()->json([
            'message' => __('responses.hotel.stored'),
            'response' => new HotelResource($hotel)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return Response
     */
    public function edit(Hotel $hotel)
    {
        // $hotel = Hotel::find($id);
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Hotel  $hotel
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_name'  => 'required',
            'accommodations' => 'nullable|array'
        ]);

        $hotel = Hotel::find($id);
        $hotel->name = $request->get('hotel_name');
        $hotel->accommodations = $request->get('accommodations');
        $hotel->save();

        return response()->json([
            'message' => __('responses.hotel.updated'), 
            'response' => new HotelResource($hotel)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        $hotel->delete();
        
        return response()->json(['message' => __('responses.hotel.destroyed')], 200);
    }

    public function getAccommodations($name) {
        return response()->json(Hotel::where('name', '=', $name)->first()->accommodations);
    }
}
