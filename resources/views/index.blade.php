@extends('master')

@section('content')

    <div class="container ">
        <h3 class="text-center my-4">Blog Posts</h3>
        <div class="row">
            <div class="col-7  mx-auto">
                <div class="my-2">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" value="{{ request('keyword') }}" name="keyword" class="form-control">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                @isset($category)
                    <div class="d-flex mb-3 justify-content-between align-items-center">
                        <p class="mb-0">Filter by <strong>" {{ $category->title }} "</strong></p>
                        <a class="btn btn-primary btn-sm" href="{{ route('page.index') }}">All Posts</a>
                    </div>
                @endisset
                    @if(request('keyword'))
                        <div class="d-flex justify-content-between">
                            <p>Search Result for <strong>" {{ request('keyword') }} "</strong></p>
                            <a class="text-decoration-none" href="{{ route('page.index') }}">Clear result <i class="bi  bi-trash3-fill"></i></a>
                        </div>
                    @endif
            @forelse($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>{{ $post->title }}</h4>
                        <a href="{{ route('page.category',$post->category->slug) }}">
                            <span class="badge bg-primary">{{ $post->category->title }}</span>
                        </a>
                        <p class=" small">
                            {{ $post->excerpt }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <p class="mb-0 small ">{{ $post->user->name }}</p>
                                <p class="mb-0 small ">{{ $post->created_at->diffForHumans() }}</p>
                            </div>

                            <a href="{{ route('page.detail',$post->slug) }}" class="btn btn-sm btn-outline-primary">See more</a>
                        </div>
                    </div>
                </div>
            @empty
            <div class="card">
                <div class="card-body">
                    <p>There is no post</p>
                </div>
            </div>
            @endforelse
                {{ $posts->links() }}

            </div>

        </div>
    </div>


@stop
