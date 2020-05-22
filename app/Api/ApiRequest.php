<?php


namespace App\Api;


use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class ApiRequest
{
    /**
     * @var PendingRequest
     */
    protected $http;

    public function __construct(ApiClient $client)
    {
        $this->http = Http::withOptions($client->getOptions());
    }
}
