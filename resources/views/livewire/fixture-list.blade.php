<div class="col-12">
    @php
    $fixture = null;
    @endphp
    @foreach($matches as $match)
    @if($fixture ==null)
    @php $fixture = $match->matchday
    @endphp
    <h5 class=" p-3 mb-3 rounded">
        Matchday {{$fixture}}
    </h5>
    @else
    @if($fixture != $match->matchday)
    @php $fixture = $match->matchday
    @endphp
    <h5 class="p-3 mb-3 rounded">
       Matchday {{$fixture}}
    </h5>
    @endif
    @endif
    @if($match->status == "SCHEDULED")
    <a href="{{route('bet', ['id' => $match->id])}}" style="text-decoration:none; color:black;">
        <div class="shadow p-3 mb-2 rounded" id="match-div">
            <div class="row text-center">
                <div class="col">
                    {{$match->homeTeam}}
                </div>
                <div class="col result">
                    <p>Vs</p>
                </div>
                <div class="col">
                    {{$match->awayTeam}}
                </div>
                <div class="col upcomingSchedule">
                    {{date("F j ,g:i A", strtotime($match->time))}}
                </div>
                <div class="col">
                    <div class="lets-bet w-100">
                        Bet !
                    </div>
                </div>
            </div>
        </div>
    </a>
    @elseif($match->status == "Ongoing")
    <div class="shadow p-3 mb-2 rounded" id="match-live">
        <div class="row text-center">
            <div class="col">
                {{$match->homeTeam}}
            </div>
            <div class="col result">
                <p>Vs</p>
            </div>
            <div class="col">
                {{$match->awayTeam}}
            </div>
            <div class="col">
                {{date("g:i A", strtotime($match->time))}}
            </div>
            <div class="col">
                <div class="w-100 bg-danger text-white">LIVE</div>
            </div>
        </div>
    </div>
    @elseif ($match->status == "FINISHED")
    <div class="shadow p-3 mb-2 rounded " id="match-finished">
        <div class="row text-center">
            <div class="col">
                {{$match->homeTeam}}
            </div>
            <div class="col result">
                <p>{{$match->result}}</p>
            </div>
            <div class="col">
                {{$match->awayTeam}}
            </div>
            <div class="col">
                {{date("g:i A", strtotime($match->time))}}
            </div>
            <div class="col hide-small">
                <div class="w-100 bg-dark text-white">Finished</div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>