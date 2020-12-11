<?php

namespace App\Http\Controllers;

use DateInterval;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    private $apiKey = "250b6609c4d94da5989532115ee27a24";
    
    public function index()
    {
        var_dump(cache('date'));
        var_dump(date('Y-m-d'));
        // $today = new DateTimeImmutable();
        
        // $oneWeekFromToday = $today->add(DateInterval::createFromDateString('10 days'));
        // echo $today->format('Y-m-d') . "\n<br>";
       
        // $response = Http::withHeaders(['X-Auth-Token' => $this->apiKey,])->get('https://api.football-data.org/v2/matches', [
        //     'competitions' => '2021',//competitions id for PremierLeague
        //     'dateFrom' => $today->format('Y-m-d'),
        //     'dateTo' => $oneWeekFromToday->format(('Y-m-d')),
        //     ]);
        //     $responseObject = $response->object();
        //     dd($responseObject);
        //     $matches = $responseObject->matches;
            
        //     if ($matches != null) {
        //         foreach ($matches as $match) {
        //             dd($match);
        //         }
        //     }
        // }
    }
}