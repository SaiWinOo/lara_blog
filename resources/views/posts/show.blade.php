@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row ">
            @include('sidebar')
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item " aria-current="page"><a href="{{ route('post.index') }}">Post</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
                            </ol>
                        </nav>
                        <h4>{{ $post->title }}</h4>
                        <hr>
                        <div class="mb-3">
                            <p class="badge bg-secondary">
                                <i class="bi bi-grid"></i>
                                {{ $post->category->title ?? "uncategorized" }}
                            </p>
                            <p class="badge bg-secondary">
                                <i class="bi bi-person"></i>
                                {{ $post->user->name ?? "unknown"  }}
                            </p>
                            <p class="badge bg-secondary">
                                <i class="bi bi-calendar-check-fill"></i>
                                {{ $post->created_at->format('d M Y') }}
                            </p>
                            <p class="badge bg-secondary">
                                <i class="bi bi-clock"></i>
                                {{ $post->created_at->format('h:i A') }}
                            </p>
                        </div>

                        @if(isset($post->featured_image))
                            <div class="mb-3">
                                <img class="w-100" src="{{ asset('storage/'.$post->featured_image) }}" alt="">
                            </div>
                        @endif

                        <p>
                            {{ $post->description }}
                        </p>
                        @foreach($post->photos as $photo)
                            <img src="{{ asset('storage/'.$photo->name) }}" class="w-25" alt="">
                        @endforeach
                        <div class="mt-3 justify-content-between d-flex">
                            <a class="btn btn-outline-primary" href="{{ route('post.create') }}">Create New Post</a>
                            <a class="btn btn-primary" href="{{ route('post.index') }}">All posts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script>
        @if(session('status'))
        showToast("{{ session('status') }}")
        @endif
    </script>
@endpush
