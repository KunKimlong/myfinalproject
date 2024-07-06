@extends('backend.master')
@section('content')

    @if (Session::has('success'))
        <script>
            var text = "{{Session::get('success')}}";
            Swal.fire({
                title: "Success",
                text,
                icon: "success"
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            var text = "{{Session::get('error')}}";
            Swal.fire({
                title: "Error",
                text,
                icon: "error"
            });
        </script>
    @endif


    @section('site-title')
        Admin | Update Product
    @endsection
    @section('page-main-title')
        Update Product
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('updateProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$product->name}}" placeholder="Name" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Quantity</label>
                                    <input class="form-control" value="{{$product->qty}}" type="text" name="qty" placeholder="Quantity" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Regular Price</label>
                                    <input class="form-control" value="{{$product->regularPrice}}" type="number" placeholder="Regular Price" name="regular_price" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Discount</label>
                                    <select name="discount" class="form-select" id="">
                                        @foreach ($discounts as $item)
                                        <option value="{{$item->id}}" @if($product->discountId == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Size</label>
                                    <select name="size[]" class="form-control size-color" multiple="multiple">

                                        @foreach ($sizes as $item)
                                            @php
                                                $isSelected = $product->sizes->contains('id', $item->id);
                                            @endphp
                                            <option value="{{ $item->id }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Color</label>
                                    <select name="color[]" class="form-control size-color" multiple="multiple">
                                         @foreach ($colors as $item)
                                            @php
                                                $isSelected = $product->colors->contains('id', $item->id);
                                            @endphp
                                            <option value="{{$item->id}}" {{ $isSelected ? 'selected' : '' }}>{{$item->name}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        @foreach ($categories as $item)
                                        <option value="{{$item->id}}" @if($product->categoryId == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                    <input type="text" name="old_thumbnail" value="{{$product->thumbnail}}" id="">
                                    <img src="{{url('images/'.$product->thumbnail)}}" alt="" width="100px" class="my-2">
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Product">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
