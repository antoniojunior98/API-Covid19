<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Services\Covid19;

class Covid19Controller extends AbstractController
{   
    private $covid19Service;

    public function __construct(Covid19 $covid19Service)
    {
        $this->covid19Service = $covid19Service;
    }

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $this->response->json($this->covid19Service->run())->withStatus(200);
    }
}
