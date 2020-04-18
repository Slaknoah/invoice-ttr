<?php

namespace App\Http\Controllers;

use App\Requisite;
use Illuminate\Http\Request;

class RequisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisites = Requisite::all();
        return view('settings.requisites.index', compact('requisites'));
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
            'requisite_name'  => 'required',
            'requisite' => 'required'
        ]);

        $requisite = new Requisite([
            'name' => $request->get('requisite_name'),
            'data' => $request->get('requisite')
        ]);
        $requisite->save();
        return redirect()->back()->with('success', 'Реквизит добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function show(requisite $requisite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisite = Requisite::find($id);
        return view('settings.requisites.edit', compact('requisite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'requisite_name'  => 'required',
            'requisite' => 'required'
        ]);
        $requisite = Requisite::find($id);
        $requisite->name = $request->get('requisite_name');
        $requisite->data = $request->get('requisite');
        $requisite->save();
        return redirect('/requisites')->with('success', 'Реквизит обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\requisite  $requisite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requisite = Requisite::find($id);
        $requisite->delete();

        return redirect()->back()->with('success', 'Реквизит удален!');
    }
}
