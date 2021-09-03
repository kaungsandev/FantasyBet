<x-app-layout>
<div class="w-4/6 flex-1">
    @livewire('fixture-list')
    <div class="w-full grid grid-cols-1 gap-1 mx-auto  py-4">
        @livewire('news-view')
    </div>
</div>
</x-app-layout>