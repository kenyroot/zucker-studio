<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeatherResource;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $weather = collect(json_decode(Cache::get('weather'), true));

        if(!$weather) {
            $endpoint = "https://api.weather.yandex.ru/v2/forecast";
            $headers = ['X-Yandex-API-Key' => env('API_KEY','1fed6445-a991-4165-85a6-1b50c6e83112')];
            $client = new Client(['headers'=>$headers]);
            $lat = "40.7142700";
            $lon = "-74.0059700";
            $params  = [
                'query' => [
                    'lat' => $lat,
                    'lon' => $lon,
                ],
            ];
            $response = $client->get($endpoint, $params);
            $weather = collect(json_decode($response->getBody()->getContents(), true));
            Cache::put('weather', $weather->toJson(),now()->addMinutes(10));
        }
        return view('index',['weather'=> [
            'now' => Carbon::parse($weather['now'])->format('d.m.Y'),
            'temp' => $weather['fact']['temp'],
            'icon' => $weather['fact']['icon'],
            'windSpeed' => $weather['fact']['wind_speed']
        ]]);
    }
}
