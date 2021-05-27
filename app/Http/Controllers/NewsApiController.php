<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class NewsApiController extends Controller
{
    //https://newsapi.org/v2/top-headlines?country=gb&category=sports&apiKey=ff976ffa52d2420a951d33cd46781487
    private $apiKey; 
    private $country; 
    private $category; 
    private $page;
    
    public function __construct(){
        $this->apiKey = 'ff976ffa52d2420a951d33cd46781487';
        $this->page =1; //$this->page = private $page;
    }
    //Requesting API
    public function getNewsFromApi(){
            $api_response = Http::get(
                'https://newsapi.org/v2/top-headlines?',
                [
                    'country'=>'gb',
                    'category'=>'sports',
                    'apiKey'=> $this->apiKey,
                    'page'=>$this->page,
                    ]
                );
                $response = $api_response->getBody()->getContents();
                $decoded = json_decode($response);
                $news = $decoded->articles;
                Cache::put('news', $news, now()->addMinutes(30));
            
                return $news;
                //return response()->json($news);
        }
        //home page news teaser;
        public function index(){
            $user = Auth::user();
            $news = Cache::get('news');
            return view('news',compact('news','user'));
        }
}
    