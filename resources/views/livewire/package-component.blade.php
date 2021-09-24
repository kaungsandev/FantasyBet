<div class="flex flex-1 mt-12">
    <!-- component -->
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <div class="font-sans min-h-screen flex justify-center items-start w-full">
        @if ($subscription)
        <div class="w-full flex flex-col ">
        <p class="w-full mb-2 text-black font-bold text-2xl text-center">Your Plan</p>
        <div class="w-full bg-yellow-300 shadow-lg flex flex-row items-center justify-around p-8 mt-14">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 " viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
             <h1 class="w-full pl-4 text-theme-color">{{$subscription->package->name}} Package</h1>
            <p class="w-full text-right text-gray-800">expire at: <span class="text-black font-bold">{{$subscription->expire_date}}</span>    </p>
        </div>
        </div>
    @else
       <div class="">
        <div class="text-center font-semibold">
            <h1 class="text-5xl">
                <span class="text-blue-700 tracking-wide">Flexible </span>
                <span>Plan</span>
            </h1>
            <p class="pt-6 text-xl text-gray-400 font-normal w-full px-8 md:w-full">
                Choose a plan that works best for you 
            </p>
        </div>
        <div class="pt-24 flex flex-row">
            <!-- Basic Card -->
            @foreach ($packages as $package)
            @if($package->auto_sub == false)
            <div class="w-96 p-8 bg-white text-center rounded-3xl pr-16 shadow-xl">
                <h1 class="text-black font-semibold text-2xl">{{$package->name}}</h1>
                <p class="pt-2 tracking-wide">
                    <span class="text-gray-400 align-top">&euro; </span>
                    <span class="text-3xl font-semibold">{{$package->amount}}</span>
                    <span class="text-gray-400 font-medium">/ {{$package->duration}} days</span>
                </p>
                <hr class="mt-4 border-1">
                <div class="pt-8">
                    <p class="font-semibold text-gray-400 text-left flex flex-row justify-start">
                        <span class="material-icons align-middle">
                            priority_high
                        </span>
                        <span class="pl-2">
                           Re-activate <span class="text-black">manually</span>
                        </span>
                    </p>
                    <p class="font-semibold text-gray-400 text-left pt-5">
                        <span class="material-icons align-middle">
                            done
                        </span>
                        <span class="pl-2">
                            For <span class="text-black">{{$package->duration}} days</span>
                        </span>
                    </p>
                    <p class="font-semibold text-gray-400 text-left pt-5">
                        <span class="material-icons align-middle">
                            done
                        </span>
                        <span class="pl-2">
                            <span class="text-black">&euro;{{
                                round($package->amount/$package->duration)}}</span> per day
                        </span>
                    </p>
                    
                    <a href="#" class="">
                        <p class="w-full py-4 bg-blue-600 mt-8 rounded-xl text-white">
                            <span class="font-medium">
                                Subscribe
                            </span>
                            <span class="pl-2 material-icons align-middle text-sm">
                                east
                            </span>
                        </p>
                    </a>
                </div>
            </div>
            <!-- Auto sub Card -->
            @else   
            <div class="w-80 p-8 bg-gray-900 text-center rounded-3xl text-white border-4 shadow-xl border-white transform ">
                <h1 class="text-white font-semibold text-2xl">{{$package->name}}</h1>
                <p class="pt-2 tracking-wide">
                    <span class="text-gray-400 align-top">&euro;</span>
                    <span class="text-3xl font-semibold">{{$package->amount}}</span>
                    <span class="text-gray-400 font-medium">/ {{$package->duration}} days</span>
                </p>
                <hr class="mt-4 border-1 border-gray-600">
                <div class="pt-8">
                    <p class="font-semibold text-gray-400 text-left">
                        <span class="material-icons align-middle">
                            done
                        </span>
                        <span class="pl-2">
                            Re-activate <span class="text-white">automatically</span>
                        </span>
                    </p>
                    <p class="font-semibold text-gray-400 text-left pt-5">
                        <span class="material-icons align-middle">
                            done
                        </span>
                        <span class="pl-2">
                            For <span class="text-white">{{$package->duration}} days</span>
                        </span>
                    </p>
                    <p class="font-semibold text-gray-400 text-left pt-5">
                        <span class="material-icons align-middle">
                            done
                        </span>
                        <span class="pl-2">
                            <span class="text-white">&euro;{{
                                round($package->amount/$package->duration)}}</span> per day
                        </span>
                    </p>
                    
                    <button wire:click='subscribePlan({{$package}})' class="w-full h-auto mt-8">
                        <p class="w-full py-4 bg-blue-600  rounded-xl text-white">
                            <span class="font-medium">
                               Subscribe
                            </span>
                            <span class="pl-2 material-icons align-middle text-sm">
                                east
                            </span>
                        </p>
                    </button>
                </div>
                <div class="absolute top-4 right-4">
                    <p class="bg-blue-700 font-semibold px-4 py-1 rounded-full uppercase text-xs">Popular</p>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
       @endif
       
    </div>
</div>
