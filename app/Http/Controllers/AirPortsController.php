<?php

namespace App\Http\Controllers;

use App\AirPort;
use Predis\Client;
use \Illuminate\Http\JsonResponse;

class AirPortsController extends Controller
{
    public function index(): JsonResponse
    {
        $redis = $this->getRedis();
        $cacheKey = 'allAirPorts';

        if ($redis->exists($cacheKey)) {
            $data = json_decode($redis->get($cacheKey), true);

        } else {
            $data = AirPort::allDataBase();
            $redis->setex($cacheKey, 3600, json_encode($data));

        }

        return response()->json($data);
    }

    public function getAirPortSpecific($id): JsonResponse
    {
        $redis = $this->getRedis();
        $cacheKey = 'airports:' . $id;

        if ($redis->exists($cacheKey)) {
            $data = json_decode($redis->get($cacheKey), true);

        } else {
            $data = AirPort::specificAirPort($id);

            $redis->setex($cacheKey, 3600, json_encode($data));

        }

        return response()->json($data);
    }

    public function getRedis(): Client
    {
        return new Client([
            'scheme' => 'tcp',
            'host'   => env('REDIS_HOST', '127.0.0.1'),
            'port'   => env('REDIS_PORT', 6379),
        ]);
    }
}
