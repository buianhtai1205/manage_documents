@extends('super_admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/validator.css') }}">
@endpush
@section('content')
    <h4>Update user</h4> <br />

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

    <form id="form-1" action="{{ route('super_admin.user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input value="{{ $user->name }}" type="text" class="form-control" id="name" name="name"  placeholder="Enter Name" />
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="username">Username</label>
            <input value="{{ $user->username }}" type="text" class="form-control" id="username" name="username"  placeholder="Enter username" />
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="password">Password (Default: 123456)</label>
            <input value="{{ $user->password }}" type="password" class="form-control" id="password" name="password" placeholder="Enter password" />
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="document">Document</label>
            <select id="document" name="document_id" class="form-control">
                @foreach($documents as $document)
                    <option
                        value="{{ $document->id }}"
                        @if($document->id == $user->document_id)
                            selected
                        @endif
                    >
                        {{ $document->name }}
                    </option>
                @endforeach
            </select>
            <span class="form-message"></span>
        </div> <br />
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control">
                <option @if($user->role === 'user') selected  @endif value="user">User</option>
                <option @if($user->role === 'admin') selected  @endif value="admin">Admin</option>
                <option @if($user->role === 'super_admin') selected  @endif value="super_admin">Super Admin</option>
            </select>
            <span class="form-message"></span>
        </div> <br />
        <button type="submit" class="btn btn-success">Update</button>
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
