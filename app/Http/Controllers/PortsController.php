<?php

namespace App\Http\Controllers;

use App\Port;
use Predis\Client;
use \Illuminate\Http\JsonResponse;

class PortsController extends Controller
{
    public function index(): JsonResponse
    {
        $redis = $this->getRedis();
        $cacheKey = 'allPorts';

        if ($redis->exists($cacheKey)) {
            $data = json_decode($redis->get($cacheKey), true);

        } else {
            $data = Port::allDataBase();
            $redis->setex($cacheKey, 3600, json_encode($data));
        }

        return response()->json($data);
    }

    public function getPortSpecific($id): JsonResponse
    {
        $redis = $this->getRedis();

        $cacheKey = 'ports:' . $id;

        if ($redis->exists($cacheKey)) {
            $data = json_decode($redis->get($cacheKey), true);

        } else {
            $data = Port::specificPort($id);

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
