<x-app-layout>
	<div class="w-full flex-col max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8n">
		<div class="shadow bg-white flex-col p-5 text-xs lg:text-2xl">
			<div class="w-full flex justify-between border-b-2 border-r-2 border-l-2 p-2 bg-gradient-to-r from-blue-700 to-red-700 text-white">
				<h3>Matchday {{$match->matchday}}</h3>
				<p>{{date("F j ,g:i A", strtotime($match->time))}}</p>
			</div>
			<div class="w-full mt-5 flex text-center justify-around">
				<p class="font-bold m-2 border-b-2 border-blue-700">{{ $match->homeTeam }}</p>
				<p class="m-2">Vs</p>
				<p class="font-bold m-2 border-b-2 border-red-700">{{ $match->awayTeam }}</p>
			</div>
			@if ($totalCount != 0)
			<div class="w-full text-gray-400 mt-5 flex text-center justify-evenly text-sm">
				<p class="m-2">Supports: {{ round($homeTeamCount,2) }}%</p>
				<p class="m-2">Total: {{ $totalCount }}</p>
				<p class="m-2">Supports: {{ round($awayTeamCount ,2)}}%</p>
			</div>
			@endif
			<div class="w-full flex justify-center my-5 text-gray-700 text-sm">
				Choose Your Bet
			</div>
			<div class="w-full mt-5 flex-col lg:flex-row text-center text-xs">
				<button class="w-full lg:w-1/4 h-8 bg-blue-600 hover:bg-black px-3 py-1 rounded text-white mb-3 bet-modal" id="HOME_TEAM">Home Win</button>
				<button class="w-full lg:w-1/4 h-8 bg-gray-600 hover:bg-black px-3 py-1 rounded text-white mb-3 bet-modal" id="DRAW">Draw</button>
				<button class="w-full lg:w-1/4 h-8 bg-red-600 hover:bg-black px-3 py-1 rounded text-white mb-3 bet-modal" id="AWAY_TEAM">Away Win</button>	
			</div>
		</div>
	</div>
	<!-- component -->
	
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
				<input type="hidden" name="matchId" value="{{ $match->id }}">
				<input id="winner" type="hidden" name="winner">
				<div class="flex justify-end items-center w-100 border-t p-3">
					<button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancel</button>
					<button type="submit" class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">Oke</button>
				</div>
			</form>
		</div>
	</div>
	
	<script>
		const modal = document.querySelector('.modal');
		
		const openModal = document.querySelectorAll('.bet-modal');
		const closeModal = document.querySelectorAll('.close-modal');
		
		openModal.forEach(open=> {
			open.addEventListener('click', function (){
			document.getElementById('modal-title').innerText = "Choose :"+ this.id;
			document.getElementById('winner').value= this.id;
			modal.classList.remove('hidden')
		});
		})
		
		closeModal.forEach(close => {
			close.addEventListener('click', function (){
				modal.classList.add('hidden')
			});
		});
	</script>
</x-app-layout>