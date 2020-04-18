<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;
use App\Http\Resources\HotelResource;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return HotelResource::collection(Hotel::orderBy('created_at', 'desc')->paginate(config('resources.items_per_page')));
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        // $hotel = Hotel::find($id);
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
