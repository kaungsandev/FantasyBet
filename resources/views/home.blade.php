<x-app-layout>
    @section('page_title','Home')

<div class="w-full flex-1">
   @if (is_null(auth()->user()->fav_team))
   @livewire('update-favourite-team')
   @endif
   @livewire('fixture-list')
</div>
</x-app-layout>