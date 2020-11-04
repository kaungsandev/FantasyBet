@extends('layouts.app')
@section('coin')
{{\Auth::user()->coin}}
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('css/custominput.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row mb-2 sticky-top" class="z-index: 100;">
        <div class="col-12">
            <form class="w-100">
                <div class="group">      
                    <input class="w-100" id="searchBar" type="text" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Search by player name</label>
                </div>      
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2" id="card-container">
        @foreach ($players as $item)
        <div class="col box mb-4">
            <div class="card h-100 shadow ">
                <div class="card-body h-100 text-center">
                    <div class="row text-center">
                        <div class="col-12">
                            <h5 class="card-title">{{$item->first_name. ' '.$item->second_name}}</h5>
                            <p class="card-text">{{$item->news}}</p>
                        </div>
                        <div class="col-12 mt-5">
                            <p><i class="far fa-clock"></i> {{$item->minutes}}min played.</p>
                        </div>
                        <div class="col-4">
                            <p>Penalty Saved:</p><p> {{$item->penalties_saved}}</p>
                        </div>
                        <div class="col-4">
                            <p>Clean Sheets:</p><p>{{$item->clean_sheets}}</p>
                        </div>
                        <div class="col-4">
                            <p>Goals conceded:</p><p> {{$item->goals_conceded}}</p>
                        </div>
                        <div class="col-4">
                            <p>Goals Score:</p><p> {{$item->goals_scored}}</p>
                        </div>
                        <div class="col-4">
                            <p>Assits: </p><p>{{$item->assists}}</p>
                        </div>
                        <div class="col-4">
                            <p>Now Cost: </p><p>$ {{$item->now_cost/10}}</p>
                        </div>
                    </div>
                </div>
            </div> 
            
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>  
      $(document).ready(function(){
    var $search = $("#searchBar").on('input',function(){
        var matcher = new RegExp($(this).val(), 'gi');
        $('.box').show().not(function(){
            return matcher.test($(this).find('.card-title').text())
        }).hide();
    })
})
        

</script>
@endsection
