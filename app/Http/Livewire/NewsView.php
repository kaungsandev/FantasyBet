<?php

namespace App\Http\Livewire;

use App\Http\Controllers\NewsApiController;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class NewsView extends Component
{
    public $news;
    public function mount(NewsApiController $newsApiController){
        if(cache('news')){
            $this->news = cache('news');
        }else{
            $this->news = $newsApiController->getNewsFromApi();
            Cache::add('news', $this->news, now()->addHour());
        }
    }
    public function render()
    {
        return view('livewire.news-view');
    }
}