<?php


namespace App\Services\Clients;
use App\Contracts\Client as IClient;
use GuzzleHttp\Client;
class TripAdvisor implements IClient
{
    private $baseUrl;
    private $apiKey;
    private $host;
    private $client;

    public function __construct()
    {
        $this->baseUrl  = config('api.rapidapi_tripadvisor.base_url');
        $this->apiKey   = config('api.rapidapi_tripadvisor.api_key');
        $this->host     = config('api.rapidapi_tripadvisor.host');
        $this->client   = new Client([
            'base_uri'  =>  $this->baseUrl,
            'headers'   =>  [
                "X-RapidAPI-Host"   => $this->host,
                "X-RapidAPI-Key"    => $this->apiKey
            ]
        ]);
    }

    public function __call($method, $parameters) {
        return $this->client->$method(...$parameters);
    }
}