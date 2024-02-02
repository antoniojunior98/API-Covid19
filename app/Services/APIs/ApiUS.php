<?php

namespace App\Services\APIs;

use Hyperf\Guzzle\ClientFactory;
use Hyperf\Context\ApplicationContext;

class ApiUS implements ApiInterface 
{
    public function request()
    {
        $container = ApplicationContext::getContainer();
        $client = $container->get(ClientFactory::class)->create();
        $apiUrl = 'https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/coronavirus-covid-19-pandemic-usa-counties/records?limit=100';
    
        try {
            $response = $client->get($apiUrl);
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            return ['US' => $data];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }
}