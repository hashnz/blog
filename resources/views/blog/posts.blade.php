@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Blog Posts</div>
                    <div class="card-body">
                        @forelse ($posts as $post)
                            <div>{{ $post['createdAt'] }} :: <a href="{{ route('blog.post', ['id' => $post['id']]) }}">{{ $post['title'] }}</a></div>
                        @empty
                            <div>No posts yet</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
