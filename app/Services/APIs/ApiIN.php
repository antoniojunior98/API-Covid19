<?php

namespace App\Services\APIs;

use Hyperf\Guzzle\ClientFactory;
use Hyperf\Context\ApplicationContext;

class ApiIN implements ApiInterface 
{
    public function request()
    {
        $container = ApplicationContext::getContainer();
        $client = $container->get(ClientFactory::class)->create();
        $apiUrl = 'https://data.covid19india.org/v4/min/timeseries.min.json';
    
        try {
            $response = $client->get($apiUrl);
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            return ['IN' => $data];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }
}