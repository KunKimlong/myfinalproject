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
        Admin | Add News
    @endsection
    @section('page-main-title')
        Add News
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('addNews')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Title</label>
                                    <input class="form-control" type="text" name="title" placeholder="title" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Thumbnal</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label">Description</label>
                                    <textarea name="description" placeholder="Description" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add News">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
