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
            title: "Success",
            text,
            icon: "success"
        });
    </script>   
    @endif

    @section('site-title')
        Admin | Update Logo
    @endsection
    @section('page-main-title')
        Update Logo
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('updateLogo')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" value="{{$logo->id}}">
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Thumbnail (Recommend image size 212 pixel x 80 pixels.)</label>
                                    <input class="form-control" type="file" name="thumbnail"/>
                                    <img src="{{url('Images/'.$logo->thumbnail)}}" alt="" width="212px" height="80px">
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Logo">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
