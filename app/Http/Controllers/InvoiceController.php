<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Service;
use App\Agent;
use App\Hotel;
use App\User;
use App\Provider;
use App\Tourist;
use App\Requisite;
use App\PaymentStatus;
use App\HotelStatus;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = User::where('role', 'manager')->get();
        $providers = Provider::all('id', 'name');
        $agents = Agent::all('id', 'name');
        $tourists = Tourist::all('id', 'name');
        $customers = $agents->concat($tourists)->all();
        $hotels = Hotel::all('name', 'accommodations');
        $hotel_statuses = HotelStatus::all('name');
        $services = Service::all('name');

        return view('invoices.invoice', compact('managers', 'providers', 'customers', 'tourists', 'hotels', 'hotel_statuses', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
