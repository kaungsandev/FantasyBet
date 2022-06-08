<div class="w-full">
    <!-- top navigation -->
    <div class="grid items-center justify-between w-full grid-cols-2 py-4 mb-2 font-bold lg:grid-cols-3">
        <a href="/" class="hidden text-xs text-gray-600 hover:text-blue-400 hover:underline lg:block">
            <i class="pr-2 fa-solid fa-circle-left"></i>Back to home
        </a>
        <h1 class="text-sm lg:text-center">Gameweek: {{ $fixture->event }}</h1>
        <h1 class="text-sm leading-relaxed text-right uppercase lg:text-lg">
            @php
                $datetime = new DateTime($fixture->kickoff_time);
                $datetime->setTimeZone(new DateTimeZone(auth()->user()->timezone));
            @endphp
            {{ $datetime->format('F j , D h:i A') }}
        </h1>
    </div>
    <!-- component -->
    <div class="flex flex-col w-full p-8 space-y-4 bg-white rounded-lg">
        {{-- Team --}}
        <div
            class="grid items-center w-full grid-cols-3 gap-2 p-4 text-sm font-bold text-center text-gray-800 lg:text-2xl">
            <p class="w-full font-bold">{{ $fixture->hometeam->name }}</p>
            <p class="w-full">Vs</p>
            <p class="w-full font-bold">{{ $fixture->awayteam->name }}</p>
        </div>
        {{-- Betting Rate --}}
        <p class="font-bold text-center text-gray-700">Betting Rate</p>
        <div class="pt-1">
            <div class="flex mb-4  text-xs rounded">
                <div class=" font-bold flex flex-col space-y-3" style="width: {{ $home_team_betting_rate }}%">
                    @if ($home_team_betting_rate > 0)
                        <p>{{ $fixture->hometeam->name }}</p>
                        <p class="text-blue-500">{{ $home_team_betting_rate }}%</p>
                    @endif
                    <div class="flex flex-col justify-center text-right text-white bg-blue-500 shadow-none ">
                        <i class="pr-2 text-lg fa-regular fa-futbol"></i>
                    </div>
                </div>
                <div class="font-bold flex flex-col space-y-3 text-center" style="width: {{ $draw_betting_rate }}%">
                    @if ($draw_betting_rate != 0)
                        <p>Draw</p>
                        <p class="text-green-500">{{ $draw_betting_rate }}%</p>
                    @endif
                    <div
                        class="flex flex-col justify-center text-xs text-center text-white bg-green-500 shadow-none overflow-hidden">
                        <i class="pl-2 text-lg fa-regular fa-futbol"></i>
                    </div>
                </div>
                <div class=" font-bold flex flex-col space-y-3 text-right"
                    style="width: {{ $away_team_betting_rate }}%">
                    @if ($away_team_betting_rate > 0)
                        <p>{{ $fixture->awayteam->name }}</p>
                        <p class="text-red-500">{{ $away_team_betting_rate }}%</p>
                    @endif
                    <div class="flex justify-start text-white bg-red-500 shadow-none">
                        <i class="pl-2 text-lg fa-regular fa-futbol"></i>
                    </div>
                </div>


            </div>
        </div>
        {{-- Previous Match History --}}
        <p class="font-bold text-center text-gray-700">Last 5 Matches</p>
        <div class="flex flex-col lg:flex-row">
            <div class="flex flex-col w-full ">
                @livewire('fixture-list', ['team_id' => $fixture->home_team])
            </div>
            <div class="flex flex-col w-full ">
                @livewire('fixture-list', ['team_id' => $fixture->away_team])
            </div>
        </div>
        <p class="font-bold text-center text-gray-700">Place Your Bet</p>
        <div class="flex-col w-full mt-5 text-xs text-center lg:flex-row">
            <button
                class="w-full h-8 px-3 py-1 mb-3 font-bold leading-5 text-white bg-blue-500 rounded lg:w-1/4 hover:bg-white hover:shadow-md hover:shadow-blue-500 hover:text-gray-700 hover:border-x hover:border-t hover:font-extrabold hover:border-blue-500 bet-modal"
                id="{{ $fixture->home_team }}">
                <span>{{ $fixture->hometeam->short_name }}</span>
                Win (x
                <span>{{ $fixture->home_team_point }}</span>
                )
            </button>
            <button
                class="w-full h-8 px-3 py-1 mb-3 font-bold leading-5 text-white bg-green-500 rounded lg:w-1/4 hover:bg-white hover:shadow-md hover:shadow-blue-500 hover:text-gray-700 hover:border-x hover:border-t hover:font-extrabold hover:border-blue-500 bet-modal"
                id="draw">
                <span>Draw</span>
                (x
                <span>{{ $fixture->draw_point }}</span>
                )
            </button>
            <button
                class="w-full h-8 px-3 py-1 mb-3 font-bold leading-5 text-white bg-red-500 rounded lg:w-1/4 hover:bg-white hover:shadow-md hover:shadow-blue-500 hover:text-gray-700 hover:border-x hover:border-t hover:font-extrabold hover:border-blue-500 bet-modal"
                id="{{ $fixture->away_team }}">
                <span>{{ $fixture->awayteam->short_name }}</span>
                Win (x
                <span>{{ $fixture->away_team_point }}</span>
                )
            </button>
        </div>
    </div>
    <div class="fixed top-0 left-0 items-center justify-center hidden w-full h-screen bg-black bg-opacity-50 modal">
        <!-- modal -->
        <div class="w-full bg-white rounded shadow-lg md:w-1/3">
            <!-- modal header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h3 class="text-lg font-semibold" id="modal-title"></h3>
                </h3>
                <button class="text-black close-modal">&cross;</button>
            </div>
            <!-- modal body -->
            <form method="POST" action="{{ route('bets.store') }}">
                @csrf
                <div class="p-3">
                    <div class="flex flex-row items-center justify-between my-4 text-xs font-bold uppercase">
                        <p>Place Your Bet Amount</p>
                        <p class="lg:hidden">&euro; {{ number_format(auth()->user()->coin) }}</p>
                    </div>
                    <input id="betamount" name="betamount" placeholder="min: 10"
                        class="w-full px-3 py-2 border-b-2 border-blue-400 border-top-0 text-grey-darkest" type="number"
                        name="coin" min="10" step="10" max="{{ Auth::user()->coin }}" required>
                </div>
                <input type="hidden" name="match_id" value="{{ $fixture->id }}">
                <input id="choice" type="hidden" name="choice">
                <div class="flex items-center justify-end p-3 text-sm border-t w-100">
                    <button class="w-24 px-3 py-1 mr-1 text-red-500 rounded hover:underline close-modal">Cancel</button>
                    <button type="submit"
                        class="w-24 px-3 py-1 text-white bg-blue-500 rounded hover:bg-white hover:text-black hover:border hover:font-bold hover:border-black">Bet</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Bet History --}}
    @livewire('bet-history', ['match_id' => $fixture->id])

    <script>
        const modal = document.querySelector('.modal');

        const openModal = document.querySelectorAll('.bet-modal');
        const closeModal = document.querySelectorAll('.close-modal');

        openModal.forEach(open => {
            open.addEventListener('click', function() {
                document.getElementById('modal-title').innerText = this.innerText;
                document.getElementById('choice').value = this.id;
                modal.classList.add('flex')
                modal.classList.remove('hidden')
                document.getElementById('betamount').focus();
            });
        })

        closeModal.forEach(close => {
            close.addEventListener('click', function() {
                modal.classList.add('hidden')
                modal.classList.remove('flex')
            });
        });
    </script>
</div>
