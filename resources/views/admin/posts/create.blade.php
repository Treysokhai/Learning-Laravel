@extends('layouts.admin')
@section('title', 'Create Post')
@section('page-header', 'Create Post')
@section('content')                                     
<form method="post" action="{{ route('posts.store') }}"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Tittle:</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label>Category:</label>
            <select class="form-control" name="category_id">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Photo:</label>
            <input type="file" name="photo_id">
        </div>
        <div class="form-group">
            <label>Body:</label>
            <textarea name="body" class="form-control" cols="30" rows="10"></textarea>
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