<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return view('settings.providers.index', compact('providers'));
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
            'provider_name'  => 'required',
            'from_email' => 'required'
        ]);

        $provider = new Provider([
            'name' => $request->get('provider_name'),
            'from_email' => $request->get('from_email'),
            'to_email' => $request->get('to_email'),
            'to_phone' => $request->get('to_phone'),
            'send_to_email' => $request->get('send_to_email'),
            'send_to_phone' => $request->get('send_to_phone')

        ]);
        $provider->save();
        return redirect()->back()->with('success', 'Поставщик добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('settings.providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'provider_name'  => 'required',
            'from_email' => 'required'
        ]);

        $provider = Provider::find($id);
        $provider->name = $request->get('provider_name');
        $provider->from_email = $request->get('from_email');
        $provider->to_email = $request->get('to_email');
        $provider->to_phone = $request->get('to_phone');
        $provider->send_to_email = $request->get('send_to_email');
        $provider->send_to_phone = $request->get('send_to_phone');
        $provider->save();
        return redirect('/providers')->with('success', 'Поставщик обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();

        return redirect()->back()->with('success', 'Поставщик удален!');
    }
}
