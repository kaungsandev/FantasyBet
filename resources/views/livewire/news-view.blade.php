<div class="w-full grid grid-cols-3 gap-12 mx-auto px-6 sm:px-6 lg:px-8n py-2">
    @foreach ($news as $new)
    <a href="{{$new->url}}">
        <div class="bg-white border-b-4 border-blue-500 w-full h-full">
            @if ($new->urlToImage)
            <img src="{{$new->urlToImage}}" alt="People" class="w-full object-cover h-32 sm:h-48 md:h-64">
            @else
                <img src="{{asset('img/default_news_cover.jpg')}}" alt="People" class="w-full object-cover h-32 sm:h-48 md:h-64">
            @endif
            <div class="p-4 md:p-6">
              <p class="text-blue-500 font-semibold text-xs mb-1 leading-none">{{$new->source->name}}</p>
              <h3 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal">{{$new->title}}</h3>
              <div class="text-sm flex items-center">
                <svg class="opacity-75 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="12" height="12" viewBox="0 0 97.16 97.16" style="enable-background:new 0 0 97.16 97.16;" xml:space="preserve">
                  <path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823    c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/>
                  <path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832    c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>
                </svg>
                <p class="leading-none">{{date('F j,Y',strtotime($new->publishedAt))}}</p>
              </div>
            </div>
          </div>
    </a>
    @endforeach
</div>
