<?php

namespace App\Http\Controllers;

use App\HotelStatus;
use Illuminate\Http\Request;

class HotelStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel_statuses = HotelStatus::all();
        return view('settings.hotel_statuses.index', compact('hotel_statuses'));
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
            'hotel_status_name'  => 'required'
        ]);

        $hotel_status = new HotelStatus([
            'name' => $request->get('hotel_status_name'),
            'email_text' => $request->get('email_text'),
            'whatsapp_text' => $request->get('whatsapp_text')
        ]);
        $hotel_status->save();
        return redirect()->back()->with('success', 'Статус отеля добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HotelStatus  $hotelStatus
     * @return \Illuminate\Http\Response
     */
    public function show(HotelStatus $hotelStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HotelStatus  $hotelStatus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel_status = HotelStatus::find($id);
        return view('settings.hotel_statuses.edit', compact('hotel_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HotelStatus  $hotelStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_status_name'  => 'required'
        ]);

        $hotel_status = HotelStatus::find($id);
        $hotel_status->name = $request->get('hotel_status_name');
        $hotel_status->email_text = $request->get('email_text');
        $hotel_status->whatsapp_text = $request->get('whatsapp_text');
        $hotel_status->save();
        return redirect('/hotel_statuses')->with('success', 'Статус отеля обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HotelStatus  $hotelStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel_status = HotelStatus::find($id);
        $hotel_status->delete();

        return redirect()->back()->with('success', 'Статус отеля удален!');
    }
}
