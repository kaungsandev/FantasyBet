<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Teams;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FixtureController extends Controller{
    
    protected $API_URL = 'https://fantasy.premierleague.com/api';
    
    public function getFixtures(){
        $response = Http::get($this->API_URL.'/fixtures/');
        $fixtures =  (object) $response->json();
        foreach ($fixtures as $fixture) {
            $date = new DateTime($fixture['kickoff_time']);
            $date->add(new DateInterval('PT1H'));
            Fixture::firstOrCreate([
                'event' => $fixture['event'],
                'finished' => $fixture['finished'], 
                'kickoff_time' => $date, 
                'started' => $fixture['started'],
                'home_team' =>$fixture['team_h'], 
                'away_team' => $fixture['team_a'], 
                'home_team_score' => $fixture['team_h_score'],
                'away_team_score' => $fixture['team_a_score'],
            ]);
        }
        Cache::put('fixtures',Fixture::all(),now()->addDays(7));
    }
}

// class FixtureController extends Controller
// {
    //     private $apiKey = "250b6609c4d94da5989532115ee27a24";
    
    //     public function getFixtureFromApi($dateFrom,$dateTo)
    //     {
        //         $success=true;
        //         $response =Http::withHeaders(['X-Auth-Token' => $this->apiKey,])->get('https://api.football-data.org/v2/matches',
        //         [
            //             'competitions' => '2021',//competitions id for PremierLeague
            //             'dateFrom' => $dateFrom->format('Y-m-d'), //this will be yesterdays's date when method called for second time
            //             'dateTo' => $dateTo->format('Y-m-d'),
            //         ]);
            //             $responseObject = $response->object();
            //             //dd($responseObject);
            //             $matches = $responseObject->matches;
            //             if($matches != null)
            //             {
                //                 foreach ($matches as $match) 
                //                 {
                    //                     Fixture::updateOrInsert(
                        //                         [//Query Filter
                            //                             'matchday' => $match->matchday,
                            //                             'homeTeam' => $match->homeTeam->name,
                            //                             'awayTeam' => $match->awayTeam->name,
                            //                         ],
                            //                         [
                                //                             'time' => $match->utcDate,
                                //                             'result' => $match->score->fullTime->homeTeam.'-'.$match->score->fullTime->awayTeam,
                                //                             'status' => $match->status,
                                //                             'winner' => $match->score->winner,
                                //                         ]);
                                //                 }
                                //                 return $success;
                                //             }
                                //         return !$success;
                                //     }
                                //     //auto update fixture data from oldest SCHEDULED FIXUTRE
                                //     public function updateFixtureFromApi(){
                                    
                                    //     try {
                                        //         $dateFrom = Fixture::where('status','SCHEDULED')->orderBy('time','asc')->firstorFail()->time;
                                        //     } catch (\Throwable $th) {
                                            //         $message = "404";
                                            //         return $message;
                                            //     }
                                            //     //utc time format to string
                                            //     $dateFrom = date('Y-m-d',strtotime($dateFrom));
                                            //     //Immutable is important
                                            //     $dateFrom = DateTimeImmutable::createFromFormat('Y-m-j', $dateFrom);
                                            //     $dateTo = $dateFrom->add(DateInterval::createFromDateString('7 days'));
                                            //     if($this->getFixtureFromApi($dateFrom,$dateTo)){
                                                //         return "Fixture updated";
                                                //     }
                                                //     return $message;
                                                //     }
                                                
                                                //                     /**
                                                //                     * Display a listing of the resource.
                                                //                     *
                                                //                     * @return \Illuminate\Http\Response
                                                //                     */
                                                //                     public function index()
                                                //                     {
                                                    //                         //
                                                    //                         $fixture = Fixture::all();
                                                    //                         return view('admin.fixture', compact('fixture'));
                                                    //                     }
                                                    
                                                    //                     /**
                                                    //                     * Show the form for creating a new resource.
                                                    //                     *
                                                    //                     * @return \Illuminate\Http\Response
                                                    //                     */
                                                    //                     public function create()
                                                    //                     {
                                                        //                         //
                                                        //                     }
                                                        
                                                        //                     /**
                                                        //                     * Store a newly created resource in storage.
                                                        //                     *
                                                        //                     * @param  \Illuminate\Http\Request  $request
                                                        //                     * @return \Illuminate\Http\Response
                                                        //                     */
                                                        //                     public function store(Request $request)
                                                        //                     {
                                                            //                         //
                                                            //                         Fixture::create([
                                                                //                             'matchday' => $request->matchday,
                                                                //                             'homeTeam' => $request->homeTeam,
                                                                //                             'awayTeam' => $request->awayTeam,
                                                                //                             'time'  => $request->time,
                                                                //                             'result' =>"Vs",
                                                                //                             'status' => "SCHEDULED",
                                                                //                             'winner' => "Unknown"
                                                                //                             ]);
                                                                //                             return back()->with('success',"Fixture created successfully.");
                                                                //                         }
                                                                
                                                                //                         /**
                                                                //                         * Display the specified resource.
                                                                //                         *
                                                                //                         * @param  int  $id
                                                                //                         * @return \Illuminate\Http\Response
                                                                //                         */
                                                                //                         public function show($id)
                                                                //                         {
                                                                    //                             //
                                                                    //                         }
                                                                    
                                                                    //                         /**
                                                                    //                         * Show the form for editing the specified resource.
                                                                    //                         *
                                                                    //                         * @param  int  $id
                                                                    //                         * @return \Illuminate\Http\Response
                                                                    //                         */
                                                                    //                         public function edit($id)
                                                                    //                         {
                                                                        //                             $data = Fixture::where('id', $id)->first();
                                                                        //                             $data->status ="Ongoing";
                                                                        //                             $data->save();
                                                                        //                             return back();
                                                                        //                         }
                                                                        
                                                                        //                         /**
                                                                        //                         * Update the specified resource in storage.
                                                                        //                         *
                                                                        //                         * @param  \Illuminate\Http\Request  $request
                                                                        //                         * @param  int  $id
                                                                        //                         * @return \Illuminate\Http\Response
                                                                        //                         */
                                                                        //                         public function update(Request $request)
                                                                        //                         {
                                                                            //                             //
                                                                            //                             $id = $request->id;
                                                                            //                             $data = Fixture::where('id', $id)->first();
                                                                            //                             $data->result = $request->team1_goal." | ".$request->team2_goal;
                                                                            //                             $data->winner = $request->winner;
                                                                            //                             $data->status = "Finished";
                                                                            //                             $data->save();
                                                                            
                                                                            //                             if ($request->winner != "Draw Match"){
                                                                                //                                 $point = "none";
                                                                                //                                 if ($data->winner == $data->homeTeam) {
                                                                                    //                                     $point = $data->team1_point;
                                                                                    //                                 } elseif ($data->winner == $data->awayTeam) {
                                                                                        //                                     $point = $data->team2_point;
                                                                                        //                                 }
                                                                                        //                                 return redirect()->route('betresult', ['id' => $data->id, 'winner' => $data->winner, 'point' => $point]);
                                                                                        //                             }
                                                                                        //                         }
                                                                                        
                                                                                        //                         /**
                                                                                        //                         * Remove the specified resource from storage.
                                                                                        //                         *
                                                                                        //                         * @param  int  $id
                                                                                        //                         * @return \Illuminate\Http\Response
                                                                                        //                         */
                                                                                        //                         public function destroy($id)
                                                                                        //                         {
                                                                                            //                             $fixture = Fixture::findOrFail($id);
                                                                                            //                             $fixture->delete();
                                                                                            //                         }
                                                                                            //                     }
                                                                                            