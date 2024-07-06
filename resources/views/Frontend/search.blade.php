@extends('frontend.master')
@section('title')
    Shop
@endsection
@section('content')

<main class="shop">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        Product Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @forelse ($products as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                @if ($item->salePrice != $item->regularPrice)
                                <div class="status">
                                    Promotion
                                </div>
                                @endif
                                <a href="/product/{{$item->id}}">
                                    <img src="{{url('images/'.$item->thumbnail)}}" width="450" height="500" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    @if ($item->salePrice == $item->regularPrice)
                                    <div class="price">US {{$item->regularPrice}}</div>
                                    @else
                                        <div class="regular-price"><strike> US {{$item->regularPrice}}</strike></div>
                                        <div class="sale-price">US {{$item->salePrice}}</div>
                                    @endif
                                </div>
                                <h5 class="title">{{$item->name}}</h5>
                            </div>
                        </figure>
                    </div>
                @empty
                    <h1>No Result of Products</h1>
                @endforelse
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="main-title">
                        News Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @forelse ($news as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <a href="/news-detail/{{$item->id}}">
                                    <img src="{{url('images/'.$item->thumbnail)}}" width="300" height="300" style="object-fit: cover" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <h5 class="title">{{$item->description}}</h5>
                            </div>
                        </figure>
                    </div>
                @empty
                   <h1> No result of News</h1>
                @endforelse
            </div>
        </div>
    </section>

</main>
@endsection
