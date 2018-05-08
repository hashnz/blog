@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="actions">
                            @can('update', \App\Model\Posts\Post::class)
                                <a href="{{ route('blog.update', ['id' => $post['id']]) }}">Edit</a>
                            @endcan
                            @can('delete', \App\Model\Posts\Post::class)
                                <form method="post" action="{{ route('blog.delete', ['id' => $post['id']]) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $post['id'] }}"/>
                                    <button type="submit">X</button>
                                </form>
                            @endcan
                        </div>
                        {{ $post['title'] }}
                    </div>
                    <div class="card-body">
                        {{ $post['body'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
