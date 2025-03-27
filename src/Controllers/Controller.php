<?php

namespace SPPAY\SPPAYLaravel\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;

abstract class Controller
{
    public function __construct(protected Client $client, protected ?string $accessToken = null)
    {
        $url = config('services.sspay.base_url') . '/oauth/token';

        $this->accessToken = Cache::remember('sspay_access_token', 1800, function () use ($url) {
            $response = $this->client->request('POST', $url, [
                'json' => [
                    "grant_type" => config('services.sspay.grant_type'),
                    "client_id" => config('services.sspay.client_id'),
                    "client_secret" => config('services.sspay.client_secret'),
                    "username" => config('services.sspay.username'),
                    "password" => config('services.sspay.password'),
                ]
            ]);

            $response = json_decode($response->getBody()->getContents());
            return $response->access_token;
        });
    }

    public function fetchData($endpoint): ResponseInterface
    {
        $url = config('services.sspay.base_url') . $endpoint;
        return $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer '.$this->accessToken,
            ]
        ]);
    }

    public function sendRequest($endpoint, $body): ResponseInterface
    {
        $url = config('services.sspay.base_url') . $endpoint;
        return $this->client->request('POST', $url, [
            'json' => $body,
            'headers' => [
                'Authorization' => 'Bearer '.$this->accessToken,
            ]
        ]);
    }
}
