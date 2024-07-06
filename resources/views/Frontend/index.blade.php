
@extends('frontend.master')
@section('title')
    Home
@endsection
@section('content')



<main class="home">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        NEW PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($newProduct as $item)
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
                @endforeach


            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        PROMOTION PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($promotion as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <div class="status">
                                    Promotion
                                </div>
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
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        POPULAR PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($popularProduct as $item)
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
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</main>
@endsection
