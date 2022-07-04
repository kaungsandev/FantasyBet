<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // protected $show_news, $fixtureController;
    // public function __construct(NewsApiController $news, FixtureController $fixtureController)
    // {
    //     $this->middleware('auth');
    //     $this->show_news = $news;
    //     $this->fixtureController = $fixtureController;
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(FixtureController $fixtureController)
    {
        $user = Auth::user();
        $fixtures = $fixtureController->getLatestFixture();
        // $order = User::orderBy('coin', 'desc')->take(5)->get();
        // $news = $this->show_news->getNewsFromApi();

        return view('home')->with('fixtures', $fixtures);
    }
}
