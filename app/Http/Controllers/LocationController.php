<?php
namespace App\Http\Controllers;

use App\Contracts\Client;
use App\Http\Resources\LocationResource;
use App\Location;
use App\Search\LocationSearch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $locationSearch = new LocationSearch();
        return LocationResource::collection($locationSearch->apply($request));
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
            'name'  => 'required|string',
            'code'  => 'nullable|string',
            'type'  => 'nullable|string',
            'parent_id' => 'required_if:type,city|integer',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        $parent_id = $request->get('parent_id' ) ?: 0;
        if ( $request->get('type') == 'country' )
            $parent_id = 0;

        $location = new Location([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'type' => $request->get('type') ?: 'country',
            'parent_id' => $request->get('parent_id') ?: 0,
            'latitude'  => $request->get('latitude'),
            'longitude'  => $request->get('longitude'),
        ]);
        $location->save();

        return response()->json([
            'message' => __('responses.location.stored'),
            'response' => new LocationResource($location)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string',
            'code'  => 'nullable|string',
            'type'  => 'nullable|string',
            'parent_id' => 'required_if:type,city|integer',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        $parent_id = $request->get('parent_id' ) ?: 0;
        if ( $request->get('type') == 'country' )
            $parent_id = 0;

        $location = Location::find($id);
        $location->name = $request->get('name');
        $location->code = $request->get('code');
        $location->type = $request->get('type') ?: 'country';
        $location->parent_id = $parent_id;
        $location->latitude = $request->get('latitude');
        $location->longitude = $request->get('longitude');
        $location->save();

        return response()->json([
            'message' => __('responses.location.updated'),
            'response' => new LocationResource($location)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Location $location
     * @return Response
     * @throws \Exception
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json(['message' => __('responses.location.destroyed')], 200);
    }
}