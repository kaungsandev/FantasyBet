<x-nav-link href="{{ route('billing') }}"
    class="flex justify-between w-full bg-white rounded-lg text-theme-color hover:border-none hover:shadow-none">
    <x-slot:icon>
        <i class="fa-solid fa-wallet"></i>
        <span class="text-sm font-bold lg:hidden">Account Balance: </span>
    </x-slot:icon>
    <p class="w-full text-lg text-right">
        &pound; {{ number_format(auth()->user()->coin) }}
    </p>
</x-nav-link>
