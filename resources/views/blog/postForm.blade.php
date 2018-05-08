@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a post</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" id="title" name="title" placeholder="Enter blog title" value="{{ old('title') ?? $post['title'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="body">Content</label>
                                <textarea class="form-control" id="body" name="body" rows="15">{{ old('body') ?? $post['body'] ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
