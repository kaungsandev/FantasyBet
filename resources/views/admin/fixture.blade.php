<x-admin-layout>
    {{-- Add Fixture FOrm --}}
   <div class="w-full flex flex-row">
    <div class="w-full">
        @livewire('fixture-manage')
    </div>
    <div class="w-1/4">
        @livewire('fixture-form')
   </div>
</x-admin-layout>