@extends('super_admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/validator.css') }}">
@endpush
@section('content')
    <h4>Create Document</h4> <br />

    {{--  Message  --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form id="form-1" action="{{ route('super_admin.document.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">DocsName</label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter DocsName" />
            <span class="form-message"></span>
        </div>
        <br />
        <button type="submit" class="btn btn-success">Insert</button>
        <a class="btn btn-danger" href="{{ route('super_admin.document.index') }}">Cancel</a>
    </form>
@endsection
@push('js')
    <script src="{{ asset('js/validator.js') }}"></script>
    <script>
        Validator({
            form: "#form-1",
            errorSelector: ".form-message",
            formGroupSelector: ".form-group",
            rules: [
                Validator.isRequired("#name"),
            ],
        })
    </script>
@endpush
