@extends('frontend.master')
@section('title')
    Product | Detail
@endsection
@section('content')
<main class="product-detail">

    <section class="review">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="thumbnail">
                        <img src="{{url('images/'.$product->thumbnail)}}" width="450" height="500" alt="">
                    </div>
                </div>
                <div class="col-7">
                    <div class="detail">
                        <div class="price-list">
                            @if ($product->salePrice == $product->regularPrice)
                                <div class="price">US {{$product->regularPrice}}</div>
                            @else
                                <div class="regular-price"><strike> US {{$product->regularPrice}}</strike></div>
                                <div class="sale-price">US {{$product->salePrice}}</div>
                            @endif


                        </div>
                        <h5 class="title">{{$product->name}}</h5>
                        <div class="group-size">
                            <span class="title">Color Available</span>
                            <div class="group d-flex">
                                @foreach ($product->colors as $item)
                                <div class="box-color" style="
                                            background-color:{{$item->name}}
                                    ">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Size Available</span>
                            <div class="group">
                                @foreach ($product->sizes as $item)
                                    @if (!$loop->last)
                                        {{$item->name}},
                                    @else
                                        {{$item->name}}
                                    @endif

                                @endforeach
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Description</span>
                            <div class="description">
                                {{$product->description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        RELATED PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($related_product as $item)
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

</main>

@endsection
