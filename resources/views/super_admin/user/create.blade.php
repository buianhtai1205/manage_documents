@extends('super_admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/validator.css') }}">
@endpush
@section('content')
    <h4>Create user</h4> <br />

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


    <form id="form-1" action="{{ route('super_admin.user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Name" />
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username"  placeholder="Enter username" />
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="password">Password (Default: 123456)</label>
            <input type="password" class="form-control" id="password" name="password" value="123456"  placeholder="Enter password" />
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="document">Document</label>
            <select id="document" name="document_id" class="form-control">
                @foreach($documents as $document)
                    <option value="{{ $document->id }}">{{ $document->name }}</option>
                @endforeach
            </select>
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="super_admin">Super Admin</option>
            </select>
            <span class="form-message"></span>
        </div> <br />
        <button type="submit" class="btn btn-success">Insert</button>
        <a class="btn btn-danger" href="{{ route('super_admin.user.index') }}">Cancel</a>
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
                Validator.isRequired("#username"),
                Validator.isRequired("#password"),
                Validator.isRequired("#document"),
                Validator.isRequired("#role"),
            ],
        })
    </script>
@endpush
