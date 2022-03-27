<div class="w-full">
	<!-- component -->
    <div class="flex-col w-full px-4 py-6 mx-auto rounded-lg max-w-7xl sm:px-6 lg:px-8n">
		<div class="flex-col p-5 text-xs bg-white rounded-lg shadow lg:text-2xl">
			<div class="flex justify-between w-full p-2 text-white rounded-lg bg-gradient-to-r from-blue-700 to-red-700">
				<h3>Gameweek {{$fixture->event}}</h3>
				@php
				$datetime = new DateTime($fixture->kickoff_time);
				$datetime->setTimeZone(new DateTimeZone(auth()->user()->timezone));
				@endphp
				<p>{{$datetime->format('F j ,D h:i:A')}}</p>
			</div>
			<div class="flex justify-around w-full mt-5 text-center">
				<p class="w-full m-2 font-bold">{{ $fixture->hometeam->name }}</p>
				<p class="w-full m-2">Vs</p>
				<p class="w-full m-2 font-bold">{{ $fixture->awayteam->name }}</p>
			</div>
			@if ($totalCount != 0)
			<div class="flex w-full mt-5 text-sm text-center text-gray-400 justify-evenly">
				<p class="m-2">Supports: {{ round($home_team_count,2) }}%</p>
				<p class="m-2">Total: {{ $totalCount }}</p>
				<p class="m-2">Supports: {{ round($away_team_count ,2)}}%</p>
			</div>
			@endif
			<div class="flex justify-center w-full my-5 text-sm text-gray-700">
				Choose Your Bet
			</div>
			<div class="flex-col w-full mt-5 text-xs text-center lg:flex-row">
				<button class="w-full h-8 px-3 py-1 mb-3 text-white bg-blue-600 rounded lg:w-1/4 hover:bg-black bet-modal" id="{{$fixture->home_team}}">
                    <span class="font-bold">{{ $fixture->hometeam->short_name }}</span>
                    Win (x
                    <span class="font-bold">{{$fixture->home_team_point}}</span>
                    )
                </button>
				<button class="w-full h-8 px-3 py-1 mb-3 text-white bg-green-500 rounded lg:w-1/4 hover:bg-black bet-modal" id="draw">
                    <span class="font-bold">Draw</span>
                   	(x
                    <span class="font-bold">{{$fixture->draw_point}}</span>
                    )
                </button>
				<button class="w-full h-8 px-3 py-1 mb-3 text-white bg-red-600 rounded lg:w-1/4 hover:bg-black bet-modal" id="{{$fixture->away_team}}">
                    <span class="font-bold">{{ $fixture->awayteam->short_name }}</span>
                    Win (x
                    <span class="font-bold">{{$fixture->away_team_point}}</span>
                    )
                </button>
			</div>
		</div>
	</div>
	<div class="fixed top-0 left-0 items-center justify-center hidden w-full h-screen bg-black bg-opacity-50 modal">
		<!-- modal -->
		<div class="w-full bg-white rounded shadow-lg md:w-1/3">
			<!-- modal header -->
			<div class="flex items-center justify-between px-4 py-2 border-b">
				<h3 class="text-lg font-semibold" id="modal-title"></h3></h3>
				<button class="text-black close-modal">&cross;</button>
			</div>
			<!-- modal body -->
			<form method="POST" action="{{ route('bets.store')}}">
				@csrf
				<div class="p-3">
					<p class="my-4">ဘယ်လောက်ထည့်မလဲ</p>
					<input id="betamount" name="betamount" placeholder="min: 10" class="w-full px-3 py-2 border-b-2 border-blue-400 border-top-0 text-grey-darkest" type="number" name="coin" min="10" step="10" max="{{ Auth::user()->coin }}" required>
				</div>
				<input type="hidden" name="match_id" value="{{ $fixture->id }}">
				<input id="choice" type="hidden" name="choice">
				<div class="flex items-center justify-end p-3 border-t w-100">
					<button class="px-3 py-1 mr-1 text-white bg-red-600 rounded hover:bg-red-700 close-modal">Cancel</button>
					<button type="submit" class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">Bet</button>
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
            modal.classList.add('flex')
			modal.classList.remove('hidden')
			document.getElementById('betamount').focus();
		});
		})

		closeModal.forEach(close => {
			close.addEventListener('click', function (){
				modal.classList.add('hidden')
                modal.classList.remove('flex')
			});
		});
	</script>
</div>
