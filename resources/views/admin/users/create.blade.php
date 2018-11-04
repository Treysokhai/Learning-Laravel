@extends('layouts.admin')
@section('title', 'Create User')
@section('page-header', 'Create User')
@section('content')                                     
<form method="post" action="{{ route('users.store') }}"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Name:</label>
            <input type="name" class="form-control"  placeholder="Enter Name" name="name">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" placeholder="Enter email" name="email">
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
                    <option value="{{ $role->id }}">{{  $role->name }}</option>
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
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection