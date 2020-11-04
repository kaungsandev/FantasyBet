@extends('layouts.app')
@section('coin')
{{\Auth::user()->coin}}
@endsection
@section('content')
<style>
  
  #name{
    font-size: 50px;
    line-height: 27px;
    font-weight: 300;
    font-family: "Roboto",sans-serif;
    color: #797979;
  }
</style>
<div class="container">
  <div class="row text-center">
      <div class="col-12">
        <div class="shadow-none p-3 mt-2 rounded">
        @if($user->rank_title == "တောသား")
        <img class=" img-fluid profile-photo" src="https://source.unsplash.com/wKOKidNT14w/1600x900" id="" alt="Card image cap">
        @elseif($user->rank_title == "ရွာသား")
        <img class="img-fluid profile-photo" src="https://source.unsplash.com/sAoo8EbtP8Y/1600x900" id="" alt="Card image cap">
        @endif
        <h5 class="pt-3">{{$user->name}}</h5>
        <p class="pt-2 fanta-font">Betting Level: {{$user->rank_title}}</p>
      
          <small class="text-muted">@Approved by FantasyBet</small>
 
      </div>
    </div>
  </div>
  <div class="row mt-2">
   <div class="col-12">
    <h4 class="text-muted">My History</h4>
   </div>
   <div class="col-12">
    @if(isset($record))
    @foreach($record as $result)
    @foreach ($result->hasFixture()->get() as $item)
    <div class="shadow pt-3 pl-3 mb-2 bg-white ">
      <div class="row">
        <div class=" col-lg-3 col-3 text-center">
        <p>{{$item->team1}}</p>
        </div>
        <div class=" col-lg-1  col-2   text-center result">
          <p>{{$item->result}}</p>
        </div>
        <div class="col-lg-3 col-3 text-center">
          <p>{{$item->team2}}</p>
        </div>
        <div class="col-lg-2 d-none d-lg-block text-center">
        <p>{{$result->amount}} <i class="fas fa-coins"></i></p>
        </div>
        <div class="col-lg-3 col-3 text-center">
          @if($item->winner =="Unknown") 
          <p class="text-info">Pending</p>
          @elseif($item->winnter == $result->team)
          <p class="text-success">Won !</p>
          @else
          <p class="text-danger">WASTED</p>
          @endif
        </div>
      </div>
    </div>
    @endforeach
    @endforeach
    @endif
   </div>
  </div>
</div>
@endsection
