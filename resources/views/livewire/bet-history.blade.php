<div>
  <h1 class="text-xl text-left pl-2 font-bold mb-2">History</h1>
  @foreach ($history as $each_bet)
  
  @if ($each_bet->paid == false && $each_bet->fixture->finished == false)
  {{-- bet pending --}}
  <div class="w-full align-middle flex flex-row text-xs md:text-md justify-evenly items-center text-center  font-bold bg-white pt-4 p-4 md:grid md:grid-cols-4 text-theme-color mb-1  rounded-lg">
    @elseif ($each_bet->paid ==false && $each_bet->fixture->finished ==true) 
    {{-- bet lost --}}
    <div class="w-full align-middle flex flex-row text-xs md:text-md justify-evenly items-center text-center  font-bold bg-red-600 pt-4 p-4 md:grid md:grid-cols-4 text-white mb-1  rounded-lg">
      @elseif ($each_bet->paid ==true && $each_bet->fixture->finished ==true)
      {{-- bet-win --}}
      <div class="w-full align-middle flex flex-row text-xs md:text-md justify-evenly items-center text-center  font-bold bg-blue-600 pt-4 p-4 md:grid md:grid-cols-4 text-white mb-1  rounded-lg">
        @endif
        
        {{-- Game week or User name --}}
        @if ($match_id !== null)
        {{-- Show in each bet view --}}
        
       <div class="flex flex-row md:justify-around items-center">
        <img class="w-6 h-6 rouned-lg shadodw-lg"
        src="{{asset('img/avatars/'.'avataaars-'.rand(1,12).'.png') }}" alt="">
        <p class="pl-4 md:pl-0 text-center text-gray-800">{{$each_bet->user->name}}</p>
       </div>
        @else
        {{-- Show in user history --}}
        <p class="text-left flex">
          <span class="hidden md:flex">Gameweek</span> 
          <span class="flex md:hidden">G</span>
          {{$each_bet->fixture->event}}</p>
          @endif
          
          {{-- Team Choice --}}
          @if($each_bet->winner == 'draw')
          <p class="">{{$each_bet->fixture->hometeam->short_name .'|'.$each_bet->fixture->awayteam->short_name}} 
            <span class="">Draw</span>
          </p>
          @else
          <p class="">{{$each_bet->team->name}}</p>
          @endif
          {{-- bet amount --}}
          <p class="text-center">&euro;{{$each_bet->amount}}</p>  
          
          @if ($each_bet->paid == false && $each_bet->fixture->finished == false)
          <p class="hidden md:block">{{'('.$each_bet->amount .') +'.$each_bet->amount * $each_bet->current_point}}</p>
          {{-- <p class="text-green-400">Pending</p> --}}
          @elseif ($each_bet->paid ==false && $each_bet->fixture->finished ==true)
          <p class="hidden md:block"> -{{$each_bet->amount}}</p>
          {{-- <p class="text-red-600">Lose</p> --}}
          @elseif ($each_bet->paid ==true && $each_bet->fixture->finished ==true)
          <p class="hidden md:block">{{'('.$each_bet->amount .') +'.$each_bet->amount * $each_bet->current_point}}</p>
          {{-- <p class="text-blue-600">Win</p> --}}
          @endif
          
        </div>
        @endforeach
      </div>
      