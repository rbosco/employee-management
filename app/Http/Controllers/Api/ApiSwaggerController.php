<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiSwaggerController extends Controller
{
    public function getSwagger(): string
    {
        $openapi = \OpenApi\Generator::scan(['../app']);
        header('Content-Type: application/json');
        return $openapi->toJson();
    }

    public function getSwaggerUI()
    {
        return view('swagger.index', ['server' => request()->getHttpHost()]);
    }
}
