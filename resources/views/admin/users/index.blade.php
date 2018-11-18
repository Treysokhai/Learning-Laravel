@extends('layouts.admin')
@section('title', 'List of user')
@section('page-header', 'List Of User')
@section('content')

    @if(session()->has('status'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{session('status')}}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    <img src="{{ $user->photo ? $user->photo->file : 'No Photo' }}" alt="" height="50px">
                </td>
            <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->is_active == 1? "Active": "No Active" }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
                <td>
                   
                    <form id="logout-form-delete" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: block;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type='submit' class="btn btn-danger">Delete</button>
                    </form> 
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection