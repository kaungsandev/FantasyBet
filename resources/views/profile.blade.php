<x-app-layout>
  <div class="w-full flex flex-row justify-start items-center">
    {{-- profile image --}}
    <div class="w-auto">
      <img class="w-36 h-36 rouned-lg shadodw-lg"
       src="{{asset('img/avatars/'.cache('avatar-'.auth()->user()->id))}}" alt="">
    </div>
    {{-- detail --}}
    <div class="w-full flex flex-col">
      <div class="w-full flex flex-row">
        <p class="font-bold text-3xl">{{auth()->user()->name}}</p>
      </div>
    </div>
  </div>
</x-app-layout>