<div class="w-full">
    <!-- top navigation -->
    <div class="grid items-center justify-between w-full grid-cols-3 mb-2 font-bold">
        <a href="/" class="text-xs text-gray-600 hover:text-blue-400 hover:underline">
            <i class="pr-2 fa-solid fa-circle-left"></i>Back to home
        </a>
        <h1 class="text-sm text-center">Gameweek: {{ $fixture->event }}</h1>
        <h1 class="text-lg leading-relaxed text-right uppercase">
            @php
                $datetime = new DateTime($fixture->kickoff_time);
                $datetime->setTimeZone(new DateTimeZone(auth()->user()->timezone));
            @endphp
            {{ $datetime->format('F j , D h:i A') }}
        </h1>
    </div>
    <!-- component -->
    <div class="flex flex-col w-full p-8 space-y-4 bg-white rounded-lg">
        <div
            class="grid items-center w-full grid-cols-3 gap-2 p-4 text-xs font-bold text-center text-gray-800 lg:text-2xl">
            <p class="w-full font-bold">{{ $fixture->hometeam->name }}</p>
            <p class="w-full">Vs</p>
            <p class="w-full font-bold">{{ $fixture->awayteam->name }}</p>
        </div>
        <p class="font-bold text-center text-gray-700">Betting Rate</p>
        <div class="flex flex-row w-full font-bold text-white border">
            <div class="bg-red-500 rounded-l-lg pr-2 text-right {{ $home_team_betting_rate }} ">
                <i class="w-full fa-solid fa-futbol"></i>
            </div>
            <div class="bg-blue-500 rounded-r-lg text-left pl-2 {{ $away_team_betting_rate }}">
                <i class="w-full fa-solid fa-futbol"></i>
            </div>
        </div>
        <p class="font-bold text-center text-gray-700">Last 5 matches</p>
        <div class="grid w-full grid-cols-2 gap-8">
            <div class="flex flex-col w-full space-y-2">
                @livewire('fixture-list', ['team_id' => $fixture->home_team])
            </div>
            <div class="flex flex-col w-full space-y-2">
                @livewire('fixture-list', ['team_id' => $fixture->away_team])
            </div>
        </div>
        <div class="flex-col p-5 text-xs bg-white rounded-lg shadow lg:text-2xl">
            <div class="flex justify-center w-full my-5 text-sm text-gray-700">
                Choose Your Bet
            </div>
            <div class="flex-col w-full mt-5 text-xs text-center lg:flex-row">
                <button
                    class="w-full h-8 px-3 py-1 mb-3 text-white bg-blue-600 rounded lg:w-1/4 hover:bg-black bet-modal"
                    id="{{ $fixture->home_team }}">
                    <span class="font-bold">{{ $fixture->hometeam->short_name }}</span>
                    Win (x
                    <span class="font-bold">{{ $fixture->home_team_point }}</span>
                    )
                </button>
                <button
                    class="w-full h-8 px-3 py-1 mb-3 text-white bg-green-500 rounded lg:w-1/4 hover:bg-black bet-modal"
                    id="draw">
                    <span class="font-bold">Draw</span>
                    (x
                    <span class="font-bold">{{ $fixture->draw_point }}</span>
                    )
                </button>
                <button
                    class="w-full h-8 px-3 py-1 mb-3 text-white bg-red-600 rounded lg:w-1/4 hover:bg-black bet-modal"
                    id="{{ $fixture->away_team }}">
                    <span class="font-bold">{{ $fixture->awayteam->short_name }}</span>
                    Win (x
                    <span class="font-bold">{{ $fixture->away_team_point }}</span>
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
                <h3 class="text-lg font-semibold" id="modal-title"></h3>
                </h3>
                <button class="text-black close-modal">&cross;</button>
            </div>
            <!-- modal body -->
            <form method="POST" action="{{ route('bets.store') }}">
                @csrf
                <div class="p-3">
                    <p class="my-4">ဘယ်လောက်ထည့်မလဲ</p>
                    <input id="betamount" name="betamount" placeholder="min: 10"
                        class="w-full px-3 py-2 border-b-2 border-blue-400 border-top-0 text-grey-darkest" type="number"
                        name="coin" min="10" step="10" max="{{ Auth::user()->coin }}" required>
                </div>
                <input type="hidden" name="match_id" value="{{ $fixture->id }}">
                <input id="choice" type="hidden" name="choice">
                <div class="flex items-center justify-end p-3 border-t w-100">
                    <button
                        class="px-3 py-1 mr-1 text-white bg-red-600 rounded hover:bg-red-700 close-modal">Cancel</button>
                    <button type="submit"
                        class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">Bet</button>
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
