<?php
namespace App\Http\Controllers;

use App\Contracts\Client;
class LocationController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index() {
//        $response   = $this->client->get('/attractions/list?lang=en_US&currency=USD&sort=recommended&lunit=km&limit=30&bookable_first=false&subcategory=36&location_id=293928');
//        $body       = $response->getBody();
//        dd(json_decode($body));
        dd('skdhfksjdhkfhsj');
    }
}