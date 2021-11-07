<x-guest-layout>
    <p class="leading-relaxed">Hello, <span class="font-bold">{{$user->name}}</span></p>
    <p>Another gameweek is coming again.Come and Bet on your favourite team !</p>
    <a href="{{route('bet',['id' => $fixture->id])}}" _target  class="w-auto p-2 bg-theme-color text-white rounded-md shadow-sm">Let's Bet</a>
</x-guest-layout>