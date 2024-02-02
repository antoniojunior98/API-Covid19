<?php

namespace App\Services\APIs;

use Hyperf\Guzzle\ClientFactory;
use Hyperf\Context\ApplicationContext;

class ApiBR implements ApiInterface 
{
    public function request()
    {
        $container = ApplicationContext::getContainer();
        $client = $container->get(ClientFactory::class)->create();
        $apiUrl = 'https://covid19-brazil-api.now.sh/api/report/v1';
    
        try {
            $response = $client->get($apiUrl);
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            return ['BR' => $data];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }
}