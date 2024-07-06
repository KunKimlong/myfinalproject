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
        Admin | Add Size
    @endsection
    @section('page-main-title')
        Add Size
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('addSize')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="">Name:</label>
                                    <input type="text" name="name" class="form-control" id="" placeholder="Name:">
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add Discount">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
