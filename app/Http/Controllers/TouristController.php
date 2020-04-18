<?php

namespace App\Http\Controllers;

use App\Tourist;
use Illuminate\Http\Request;
use App\Http\Resources\TouristResource;
use App\Rules\PhoneNumber;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TouristController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TouristResource::collection(Tourist::orderBy('created_at', 'desc')->paginate(config('resources.items_per_page')));
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
            'name'  => 'required',
            'phone' => ['required', new PhoneNumber],
            'email' => 'required|email|unique:tourists,email,',
            'description' => 'string|nullable'
        ]);

        $tourist = new Tourist([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'description' => $request->get('description')
        ]);
        $tourist->save();

        return response()->json([
            'message' => __('responses.tourist.stored'),
            'response' => new TouristResource($tourist)
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'phone' => [new PhoneNumber],
            'email' => 'required|email|unique:tourists,email,'.$id,
            'description' => 'string|nullable'
        ]);

        $tourist = Tourist::find($id);
        $tourist->name = $request->get('name');
        $tourist->phone = $request->get('phone');
        $tourist->email = $request->get('email');
        $tourist->description = $request->get('description');
        $tourist->save();

        return response()->json([
            'message' => __('responses.tourist.updated'),
            'response' => new TouristResource($tourist)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tourist = Tourist::find($id);
        $tourist->delete();

        return response()->json(['message' => __('responses.tourist.destroyed')], 200);
    }
}
