<x-app-layout>
    @section('page_title', 'Home')

    <div class="flex-1 w-full bg-gray-200">
        @if (is_null(auth()->user()->fav_team))
            @livewire('update-favourite-team')
        @endif
        @livewire('fixture-list', ['history' => false])
    </div>
</x-app-layout>
