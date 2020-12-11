@extends('layouts.app')
@section('coin')
{{$user->coin}}
@endsection
@section('content')
<style>
    .std_user_record {
        text-decoration: none;
        color: black;
    }
    .result{
        text-align: -webkit-center !important;
        text-align: -moz-center;
    }
    .result p{
        width: 50%;
    }
    
    #match-div {
        background-color: white;
    }
    
    #match-div:hover {
        cursor: pointer;
        color: white;
        background-color: red;
    }
</style>
<div class="container-fluid">
    <div class="row  mx-auto">
        <div class="col-lg-2 hidden-sm hidden-md w-100" id="side-profile">
            <div class="card  mb-2 rounded text-center" style="min-height: 100%">
                <img src="http://source.unsplash.com/AndE50aaHn4" class="card-img-top img-fluid profile-photo" alt="">
                <div class="row mt-5">
                    <div class="col-12">
                        <h3>{{$user->name}}</h3>
                    </div>
                    <hr style="width:80%;">
                    <div class="col-12">
                        <p class="fanta-font float-left  pl-2">Betting Level</p>
                        <p class="fanta-font float-right pr-2">{{$user->rank_title}}</p>
                    </div>
                    <div class="col-12">
                        <p class="fanta-font float-left pl-2">FantaPoint</p>
                        <p class="fanta-font float-right pr-2">{{$user->coin}} f</p>
                    </div>
                    <div class="col-12" style="margin-top: inherit;">
                        <a href="{{route('logout')}}" class="btn btn-dark w-100 p-2">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- side profile ended --}}
        {{-- main column --}}
        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="row">
                {{-- first column started --}}
                @livewire('fixture-list')
                {{-- first column ended --}}
                {{-- second column started --}}
                <div class="col-12">
                    <h3 style="border-top: 1px black solid;" class="mt-2 mb-2 p-2">Top Headlines</h3>
                    @php
                    $i = 1;    
                    @endphp
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($news as $item)
                        <div class="col mb-4">
                            <a href="{{$item->url}}" style="color: black;text-decoration:none;" target="_blank">
                                <div class="card mb-3 h-100">
                                    @if ($item->urlToImage == null)
                                    <img src="{{asset('img/blank.png')}}" class="card-img-top" alt="..." style="height: 250px; object-fit:cover;">
                                    @else
                                    <img src="{{$item->urlToImage}}" class="card-img-top" alt="..." style="height: 250px; object-fit:cover;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->title}}</h5>
                                        <p class="card-text mt-5">{{$item->description}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @php
                        if($i++ >5) break;
                        @endphp
                        @endforeach
                    </div>
                </div>
                {{-- end second column --}}
            </div>
            {{-- row --}}
        </div>
        
        {{-- main column Ended --}}
        <!-- right Column Added -->
        <div class="col-lg-3 col-md-12 col-sm-12">
            {{-- right column divided into 2 section --}}
            <div class="row">
                {{-- firstsection --}}
                <div class="col-12">
                    <table data-toggle="table" data-sort-name="coin" data-sort-order="desc" class="table">
                        <thead>
                            <tr style="background-color: #343A40; color: white;">
                                <td style="width:100%;">Top 5 Players</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($order))
                            @foreach($order as $rank)
                            <tr>
                                <td><a href="{{route('profile', ['id' =>$rank->id])}}" class="std_user_record">{{$rank->name}}
                                    <p class="float-right fanta-font">{{$rank->coin}} f</p>
                                </a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- end firstsection --}}
                {{-- secondsection --}}
                <div class="col-12">
                    
                </div>
                {{-- endsection --}}
            </div>
            {{-- row --}}
        </div>
        {{-- second column ended --}}
    </div>
</div>
@endsection
@section('js')
@endsection
