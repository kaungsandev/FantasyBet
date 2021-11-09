<div>
    <div class="w-full flex flex-row justify-start mt-12 bg-white rounded-lg items-center p-12">
            <img class="w-16 h-16 object-fill rouned-full shadodw-lg"
            src="{{asset('img/avatars/'.cache('avatar-'.auth()->user()->id))}}" alt="">
        <div class="w-full p-2 pl-4 flex flex-col justify-between text-left text-theme-color">
            <p class="font-bold text-3xl">
                {{auth()->user()->name}}
            </p>
            <div class="flex flex-row justify-between w-full">
            <p class="text-gray-400">
                {{auth()->user()->rank_title}}
            </p>
            <p class="text-gray-400">   
                Joined at: {{auth()->user()->created_at}}
            </p>
            </div>
        </div>
    </div>
</div>
