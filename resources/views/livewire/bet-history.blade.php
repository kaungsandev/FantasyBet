<div>
    <h1 class="text-xl text-left pl-2 font-bold mb-2">History</h1>
    @foreach ($history as $each_bet)
    
    @if ($each_bet->paid == false && $each_bet->fixture->finished == false)
    {{-- bet pending --}}
    <div class="w-full align-middle flex text-right font-bold bg-white pt-4 p-4 grid grid-cols-4 md:grid-cols-5 text-theme-color mb-1 text-center rounded-lg">
    @elseif ($each_bet->paid ==false && $each_bet->fixture->finished ==true) 
    {{-- bet lost --}}
    <div class="w-full align-middle flex text-right font-bold bg-red-700 pt-4 p-4 grid grid-cols-4 md:grid-cols-5 text-white mb-1 text-center rounded-lg">
    @elseif ($each_bet->paid ==true && $each_bet->fixture->finished ==true)
    {{-- bet-win --}}
    <div class="w-full align-middle flex text-right font-bold bg-red-600 pt-4 p-4 grid grid-cols-4 md:grid-cols-5 text-theme-color mb-1 text-center rounded-lg">
    @endif
    
   
     
        {{-- Game week or User name --}}
        @if ($match_id !== null)
        {{-- Show in each bet view --}}
        <div class="w-full flex justify-between">
            <div class="flex flex-col items-center">
              <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                <img class="w-12 h-12 rouned-lg shadodw-lg"
                src="{{asset('img/avatars/'.'avataaars-'.rand(1,12).'.png') }}" alt="">
              </div>
              <span class="ml-2 text-left text-gray-800">{{$each_bet->user->name}}</span>
            </div>
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
        <p class="text-left">{{$each_bet->fixture->hometeam->short_name .'|'.$each_bet->fixture->awayteam->short_name}} 
        <span class="">Draw</span>
        </p>
        @else
        <p class="text-left">{{$each_bet->team->name}}</p>
        @endif
        {{-- bet amount --}}
        <p>&euro;{{$each_bet->amount}}</p>  
        
        @if ($each_bet->paid == false && $each_bet->fixture->finished == false)
        <p class="text-md">{{'('.$each_bet->amount .') +'.$each_bet->amount * $each_bet->current_point}}</p>
        {{-- <p class="text-green-400">Pending</p> --}}
        @elseif ($each_bet->paid ==false && $each_bet->fixture->finished ==true)
        <p class=""> -{{$each_bet->amount}}</p>
        {{-- <p class="text-red-600">Lose</p> --}}
        @elseif ($each_bet->paid ==true && $each_bet->fixture->finished ==true)
        <p class="">{{'('.$each_bet->amount .') +'.$each_bet->amount * $each_bet->current_point}}</p>
        {{-- <p class="text-blue-600">Win</p> --}}
        @endif
      
    </div>
    @endforeach
</div>
