<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $apiKey = env('WEATHER_API');
        $city = $request->input('city'); // Get city from the request
        $city_response = json_decode(Http::get("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey"),true);
        $coordinates = $city_response['coord'];
        $lat = $coordinates['lat'];
        $lon = $coordinates['lon'];
        $fivedayweather_response = json_decode(HTTP::get("http://api.openweathermap.org/data/2.5/forecast?metric=imperial&lat=$lat&lon=$lon&appid=$apiKey"),true);
        $totalweather = json_encode([
            'city' => $city_response,
            'fivedayweather' => $fivedayweather_response
        ]);
        return $totalweather;
    }
}
