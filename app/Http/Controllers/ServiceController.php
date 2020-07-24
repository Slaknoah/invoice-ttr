<?php

namespace App\Http\Controllers;

use App\Search\ServiceSearch;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $serviceSearch = new ServiceSearch();
        return ServiceResource::collection($serviceSearch->apply($request));
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
            'service_name'  => 'required'
        ]);

        $service = new Service([
            'name' => $request->get('service_name')
        ]);
        $service->save();

        return response()->json([
            'message' => __('responses.service.stored'),
            'response' => new ServiceResource($service)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Service  $service
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name'  => 'required'
        ]);

        $service = Service::find($id);
        $service->name = $request->get('service_name');
        $service->save();

        return response()->json([
            'message' => __('responses.service.updated'),
            'response' => new ServiceResource($service)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return response()->json(['message' => __('responses.service.destroyed')], 200);
    }
}
