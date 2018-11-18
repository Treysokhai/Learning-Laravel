@extends('layouts.admin')
@section('title', 'Update User')
@section('page-header', 'Update User')
@section('content')


<div class="col-md-2">
<img src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" alt="" height="100px">
</div>

<div class="col-md-9">
    <form method="POST" action="{{ route('users.update', $user->id) }}"  enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PATCH')
        <div class="form-group">
            <label>Name:</label>
        <input type="name" class="form-control"  placeholder="Enter Name" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" placeholder="Enter password" name="password">
        </div>
        <div class="form-group">
            <label>Role:</label>
            <select class="form-control" name="role_id">
                <option>Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"  {{ $role->id == $user->role_id ? 'selected':'' }}>{{  $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Active:</label>
            <select class="form-control" name="is_active">
                <option value="0">0</option>
                <option value="1">1</option>
            </select>
        </div>
        <div class="form-group">
            <label>Photo:</label>
            <input type="file" name="photo_id">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection