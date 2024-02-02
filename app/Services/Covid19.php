<?php

namespace App\Services;

use App\Services\APIs\ApiBR;
use App\Services\APIs\ApiUS;
use App\Services\APIs\ApiIN;

class Covid19
{
    private $apiBR;
    private $apiUS;
    private $apiIN;

    public function __construct(ApiBR $apiBR, ApiUS $apiUS, ApiIN $apiIN)
    {
        $this->apiBR = $apiBR;
        $this->apiUS = $apiUS;
        $this->apiIN = $apiIN;
    }

    public function run()
    {
        $parallel = new \Hyperf\Coroutine\Parallel();

        $parallel->add(function () {
            return $this->apiBR->request();         
        });

        $parallel->add(function () {
            return $this->apiUS->request();         
        });

        $parallel->add(function () {
            return $this->apiIN->request();         
        });

        return $parallel->wait();
    }
}