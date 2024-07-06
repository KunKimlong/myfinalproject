@extends('frontend.master')
@section('title')
    Home
@endsection
@section('content')
<main class="shop news-blog">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        NEWS BLOG
                    </h3>
                </div>
            </div>
            <div class="row">

                @forelse ($news as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <a href="/news-detail/{{$item->id}}">
                                    <img src="{{url('images/'.$item->thumbnail)}}" alt="" width="300" height="300" style="object-fit: cover">
                                </a>
                            </div>
                            <div class="detail">
                                <h5 class="title">{{$item->description}}</h5>
                            </div>
                        </figure>
                    </div>
                @empty

                @endforelse

            </div>
        </div>
    </section>
</main>
@endsection
