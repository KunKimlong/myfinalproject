@extends('backend.master')
@section('content')
<div class="content-wrapper">
    @section('site-title')
      Admin | View Product
    @endsection
    @section('page-main-title')
      View Product
    @endsection

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

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex p-3 justify-content-between">
                <div class="d-flex justify-content-center align-items-center col-9">
                    <div class="me-5">
                        Total Product = {{$total}}
                    </div>
                    <div class="me-5">
                        @foreach ($category as $item)
                            {{$item}}
                        @endforeach
                    </div>
                </div>
                <form action="{{route('searchProduct')}}" class="col-3 d-flex">
                    <input type="text" name="query" placeholder="Search....." id="" class="form-control">
                    <button class="btn btn-success">Search</button>
                </form>
            </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Thumbnail</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>User</th>
                  <th>Category</th>
                  <th>Discount</th>
                  <th>QTY</th>
                  <th>Regular_Price</th>
                  <th>Sale_Price</th>
                  <th>Viewer</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @forelse ($products as $item)
                  <tr>
                    <td>{{$item->name}}</td>
                    <td>
                         <img src="{{url('images/'.$item->thumbnail)}}" width="80px" height="120px" style="object-fit: cover">
                    </td>
                    <td>
                        @foreach ($item->colors as $item2)
                            {{$item2->name}}
                            @if (!$loop->last)
                                , <!-- Display comma if it's not the last item -->
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->sizes as $item2)
                            {{$item2->name}}
                            @if (!$loop->last)
                                , <!-- Display comma if it's not the last item -->
                            @endif
                        @endforeach
                    </td>
                    <td>{{$item->Username}}</td>
                    <td>{{$item->CateName}}</td>
                    <td>{{$item->DiscountName}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->regularPrice}}</td>
                    <td>{{$item->salePrice}}</td>
                    <td>{{$item->viewer}}</td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{route('openUpdateProduct',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" id="remove-post-key" data-value="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @empty
                    Product is empty
                  @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-3">
          <form action="{{route('deleteProduct')}}" method="post">
            @csrf
          <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Are you sure to remove this post?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <input type="hidden" id="remove-val" name="remove_id">
                  <button type="submit" class="btn btn-danger">Confirm</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>

      <hr class="my-5" />
    </div>
    <!-- / Content -->
  </div>
</div>

@endsection
