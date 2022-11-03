@extends('master')

@section('content')

    <div class="container ">
        <h3 class="text-center my-4">Blog Posts</h3>
        <div class="row">
                <div class="col-7 mb-3 mx-auto">
                    <h4>{{ $post->title }}</h4>
                    <hr>
                    <p class="badge bg-secondary">{{ $post->category->title }}</p>
                    <div class="mb-3">
                        @if(isset($photos))
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @forelse($photos as $key=>$photo)
                                        <div class="carousel-item text-center {{ $key===0 ? "active" : "" }}">
                                            <a class="venobox" data-gall="gallery01" href="{{ asset('storage/'.$photo->name) }}"> <img src="{{ asset('storage/'.$photo->name) }}" class="mx-auto photo_carousel" alt=""></a>

                                        </div>
                                    @empty
                                    @endforelse

                                </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                            </div>
                        @endif
                    </div>
                    <p class=" small" style="white-space: pre-wrap">{{ $post->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <p class="mb-0 small ">{{ $post->user->name }}</p>
                            <p class="mb-0 small ">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="">
                            @can("update",$post)
                                <a href="{{ route('post.edit',$post->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                            @endcan
                            <a href="{{ route('page.index') }}" class="btn btn-sm btn-primary">All Posts</a>
                        </div>
                    </div>
                </div>


        </div>
    </div>


@stop
