<x-admin-layout>
    {{-- Add Fixture FOrm --}}
    <div class="flex flex-row w-full">
        <div class="w-full">
            @livewire('manage-fixture')
        </div>
        <div class="w-1/4">
            @livewire('fixture-form')
        </div>
</x-admin-layout>
