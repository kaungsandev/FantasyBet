<div class="w-1/2">
	<!-- component -->
    <div class="w-full flex-col max-w-7xl mx-auto rounded-lg py-6 px-4 sm:px-6 lg:px-8n">
		<div class="shadow bg-white flex-col p-5 rounded-lg text-xs lg:text-2xl">
			<div class="w-full flex justify-between rounded-lg  p-2 bg-gradient-to-r from-blue-700 to-red-700 text-white">
				<h3>Gameweek {{$fixture->event}}</h3>
				<p>{{date("F j ,g:i A", strtotime($fixture->kickoff_time))}}</p>
			</div>
			<div class="w-full mt-5 flex text-center justify-around">
				<p class="w-full font-bold m-2">{{ $fixture->hometeam->name }}</p>
				<p class="w-full m-2">Vs</p>
				<p class="w-full font-bold m-2">{{ $fixture->awayteam->name }}</p>
			</div>
			@if ($totalCount != 0)
			<div class="w-full text-gray-400 mt-5 flex text-center justify-evenly text-sm">
				<p class="m-2">Supports: {{ round($home_team_count,2) }}%</p>
				<p class="m-2">Total: {{ $totalCount }}</p>
				<p class="m-2">Supports: {{ round($away_team_count ,2)}}%</p>
			</div>
			@endif
			<div class="w-full flex justify-center my-5 text-gray-700 text-sm">
				Choose Your Bet
			</div>
			<div class="w-full mt-5 flex-col lg:flex-row text-center text-xs">
				<button class="w-full lg:w-1/4 h-8 bg-blue-600 hover:bg-black px-3 py-1 rounded text-white mb-3 bet-modal" id="{{$fixture->home_team}}">
                    <span class="font-bold">{{ $fixture->hometeam->short_name }}</span> 
                    Win (x 
                    <span class="font-bold">{{$fixture->home_team_point}}</span>
                    )
                </button>
				<button class="w-full lg:w-1/4 h-8 bg-green-500 hover:bg-black px-3 py-1 rounded text-white mb-3 bet-modal" id="draw">
                    <span class="font-bold">Draw</span> 
                   	(x 
                    <span class="font-bold">{{$fixture->draw_point}}</span>
                    )
                </button>
				<button class="w-full lg:w-1/4 h-8 bg-red-600 hover:bg-black px-3 py-1 rounded text-white mb-3 bet-modal" id="{{$fixture->away_team}}">
                    <span class="font-bold">{{ $fixture->awayteam->short_name }}</span> 
                    Win (x 
                    <span class="font-bold">{{$fixture->away_team_point}}</span>
                    )
                </button>	
			</div>
		</div>
	</div>
	<div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
		<!-- modal -->
		<div class="bg-white rounded shadow-lg w-1/3">
			<!-- modal header -->
			<div class="border-b px-4 py-2 flex justify-between items-center">
				<h3 class="font-semibold text-lg" id="modal-title"></h3></h3>
				<button class="text-black close-modal">&cross;</button>
			</div>
			<!-- modal body -->
			<form method="POST" action="{{ route('bets.store')}}">
				@csrf
				<div class="p-3">
					<p class="my-4">ဘယ်လောက်ထည့်မလဲ</p>
					<input name="betamount" placeholder="min: 10" class="border-b-2 border-top-0 border-blue-400 py-2 px-3 text-grey-darkest w-full" type="number" name="coin" min="10" step="10" max="{{ Auth::user()->coin }}" required>
				</div>
				<input type="hidden" name="match_id" value="{{ $fixture->id }}">
				<input id="choice" type="hidden" name="choice">
				<div class="flex justify-end items-center w-100 border-t p-3">
					<button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancel</button>
					<button type="submit" class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">Bet</button>
				</div>
			</form>
		</div>
	</div>

	{{-- Bet History --}}
	@livewire('bet-history',['match_id'=> $fixture->id])

	<script>
		const modal = document.querySelector('.modal');
		
		const openModal = document.querySelectorAll('.bet-modal');
		const closeModal = document.querySelectorAll('.close-modal');
		
		openModal.forEach(open=> {
			open.addEventListener('click', function (){
			document.getElementById('modal-title').innerText = this.innerText;
			document.getElementById('choice').value= this.id;
			modal.classList.remove('hidden')
		});
		})
		
		closeModal.forEach(close => {
			close.addEventListener('click', function (){
				modal.classList.add('hidden')
			});
		});
	</script>
</div>
