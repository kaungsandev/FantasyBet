@extends('layouts.app')
@section('coin')
{{$user->coin}}
@endsection
@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-3">
        @foreach ($news as $item)
        <div class="col mb-4">
            <a href="{{$item->url}}" style="color: black; text-decoration:none;" target="_blank">
                <div class="card h-100">
                    @if ($item->urlToImage == null)
                    <img src="{{asset('img/blank.png')}}" class="card-img-top" alt="..." style="height: 250px; object-fit:cover;">
                    @else
                    <img src="{{$item->urlToImage}}" class="card-img-top" alt="..." style="height: 250px; object-fit:cover;">
                    @endif
                    <div class="card-body h-100">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text mt-5">{{$item->description}}</p>
                    </div>
                </div> 
            </a>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection