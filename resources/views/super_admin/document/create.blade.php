@extends('super_admin.layout.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <form action="{{ route('super_admin.document.store') }}">
        <div class="form-group">
            <label for="docs_name">DocsName</label>
            <input type="text" class="form-control" id="docs_name" name="name" placeholder="Enter DocsName">
        </div>
        <br />
        <button type="submit" class="btn btn-success">Submit</button>
        <a class="btn btn-danger" href="{{ route('super_admin.document.index') }}">Cancel</a>
    </form>
@endsection
