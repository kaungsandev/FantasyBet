<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $show_news,$updateFixture;
    public function __construct(NewsApiController $news, FixtureController $updateFixture)
    {
        $this->middleware('auth');
        $this->show_news = $news;
        $this->updateFixture = $updateFixture;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(cache('date') && cache('date') !=  date("Y-m-d")){
           $this->updateFixture->getFixtureFromApi(); //update fixture data
        }
        $matches = Fixture::orderBy('id','DESC')->take(10)->get();
        $user = Auth::user();
        $order = User::orderBy('coin', 'desc')->take(5)->get();
        $news = $this->show_news->getNewsFromApi();
        return view('home', compact('matches', 'user', 'order', 'news'));
    }
}
