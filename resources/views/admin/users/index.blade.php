@extends('layouts.admin')
@section('title', 'List of user')
@section('page-header', 'List Of User')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->is_active == 1? "Active": "No Active" }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection