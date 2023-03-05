@extends('super_admin.layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endpush
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <a class="btn btn-success" href="{{ route('super_admin.document.create') }}">Insert</a>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>DocsName</th>
            <th>CreatedAt</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <thead>
        <tr>
            <th>1</th>
            <th>Laravel</th>
            <th>05/03/2023</th>
            <th>
                <a class="btn btn-primary" href="">Edit</a>
            </th>
            <th>
                <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </th>
        </tr>
        </thead>
    </table>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        Toastify({
            text: "Insert successfully!",
            duration: 3000,
            gravity: "bottom", // `top` or `bottom`
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)", // success
                // background: "linear-gradient(to right, #ff5f6d, #ffc371)", // error
            },
        }).showToast();
    </script>
@endpush
