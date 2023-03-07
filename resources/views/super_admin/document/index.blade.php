@extends('super_admin.layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endpush
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <a class="btn btn-success" href="{{ route('super_admin.document.create') }}">Insert</a>
    <table class="table table-striped table-hover" >
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
        @foreach($documents as $document)
        <tr>
            <th>{{ $document->id }}</th>
            <th>{{ $document->name }}</th>
            <th>{{ $document->created_at }}</th>
            <th>
                <a class="btn btn-primary" href="{{ route('super_admin.document.edit', $document) }}">Edit</a>
            </th>
            <th>
                <form action="{{ route('super_admin.document.destroy', $document) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </th>
        </tr>
        @endforeach
        </thead>
    </table>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        @if (session()->has('success'))
        Toastify({
            text: "{{ session()->get('success') }}",
            duration: 3000,
            gravity: "bottom", // `top` or `bottom`
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)", // success
            },
        }).showToast();
        @elseif(session()->has('error'))
        Toastify({
            text: "{{ session()->get('error') }}",
            duration: 3000,
            gravity: "bottom", // `top` or `bottom`
            style: {
                background: "linear-gradient(to right, #ff5f6d, #ffc371)", // error
            },
        }).showToast();
        @endif
    </script>
@endpush
