@extends('layouts.admin')

@section('title', 'List of Posts')
@section('page-header', 'List Of Posts')
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
                <th>Owner</th>
                <th>Category</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>
                    <img src="{{ $post->photo ? $post->photo->file : 'No Photo' }}" alt="" height="50px">
                </td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td>
                
                    <form id="logout-form-delete" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: block;">
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