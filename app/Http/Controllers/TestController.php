<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{

    public function welcome(){
        $flight_type = isset($_GET['flight_type']) ? $_GET['flight_type'] : 'DEPARTURE';

        $response = Http::get('https://bot.uzairports.com/api/fids?airport_code=TAS&flight_type='.$flight_type)->json() ;

        $flights = $response['flights'] ;

        return view('welcome', [
            'flights' => $flights,
        ]);
    }
}
