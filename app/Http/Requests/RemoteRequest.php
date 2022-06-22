<?php

namespace App\Http\Requests;

use GuzzleHttp\Client;
use App\Models\Configurations\Website;

class RemoteRequest
{
    /**
     * Client for making the remote post request.
     *
     * @var Client
     */
    protected $client;

    /**
     * Notification constructor.
     *
     * @param \App\Models\Configurations\Website $website
     */
    public function __construct(Website $website)
    {
        $this->client = new Client([
            'base_uri' => 'https://'.$website->url.'/notifications/',
            'verify' => config('app.env') === 'local' ? false : true,
        ]);
    }

    /**
     * Make the remote post request to the website.
     *
     * @param string $url
     * @param array $payLoad
     * @param string $method
     * @return mixed
     */
    public function send($url, $payLoad = [], $method = 'POST')
    {
        $response = $this->client->request($method, $url, ['json' => $payLoad]);

        return json_decode($response->getBody()->getContents());
    }
}
