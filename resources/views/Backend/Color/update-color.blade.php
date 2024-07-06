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
        Admin | Update Color
    @endsection
    @section('page-main-title')
        Update Color
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('updateColor')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" value="{{$color->id}}">
                                <div class="mb-3 col-12">
                                    <label for="">Name:</label>
                                    <input type="text" value="{{$color->name}}" name="name" class="form-control" id="" placeholder="Name:">
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Color">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
