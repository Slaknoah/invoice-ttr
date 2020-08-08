<?php
namespace App\Http\Controllers;

use App\Contracts\Client;
use App\Http\Resources\LocationResource;
use App\Search\LocationSearch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
}