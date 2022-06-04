<x-app-layout>
    @section('page_title', 'Fixtures')
    <div class="w-full">
        @livewire('fixture-list', ['history' => true])
    </div>
</x-app-layout>
