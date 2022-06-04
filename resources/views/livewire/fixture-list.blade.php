<div class="flex-col w-full pt-6 mx-auto space-y-2 md:px-4 sm:px-6 lg:px-8n">
    <!-- component -->
    @if ($fixtures->count() < 1)
        <p class="w-full font-bold text-center text-gray-400">No Fixtures Available</p>
    @else
        <div wire:loading.delay>...</div>
        @foreach ($fixtures as $fixture)
            @php
                // Format kickoff_time to DateTime
                $datetime = new DateTime($fixture->kickoff_time);
                // Set DateTime according to user's timezone;
                $datetime->setTimeZone(new DateTimeZone($user_timezone));
            @endphp

            @if ($team_id === null && $history === false)
                @if ($datetime->format('F, d l') !== $kickoff_time->format('F, d l'))
                    <p>{{ $datetime->format('F, d l') }}</p>
                    @php
                        $kickoff_time = $datetime;
                    @endphp
                @endif
            @elseif($history)
                @if ($title !== $fixture->event)
                    <p class="text-xs">Gameweek: {{ $fixture->event }}</p>
                    @php
                        $title = $fixture->event;
                    @endphp
                @endif
            @endif

            @livewire('fixture-list-item', ['fixture' => $fixture, 'datetime' => $datetime], key($fixture->id))
        @endforeach
    @endif
</div>
