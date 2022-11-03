@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row ">
            @include('sidebar')
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4>Edit Post</h4>
                        <hr>
                        <form action="{{ route('post.update',$post->id) }}" id="postUpdateForm" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('put')
                        </form>


                        <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input form="postUpdateForm" type="text" name="title" value="{{ old('title',$post->title) }}" class="form-control @error('title') is-invalid @enderror" >
                                @error('title') <small>{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Select Category </label>
                                <select type="text" form="postUpdateForm"  name="category" class="form-select @error('category') is-invalid @enderror" >
                                    <option value="0" >Select Category</option>
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option {{ $post->category_id == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category') <small>{{ $message }}</small> @enderror

                            </div>
                            <div class="mb-3 d-flex flex-wrap">
                            @foreach($post->photos as $photo)
                                     <div class="position-relative">
                                         <img style="height: 100px" class="mx-1 mb-2 rounded-3" src="{{ asset('storage/'.$photo->name) }}" alt="">
                                         <form action="{{ route('photo.destroy',$photo->id) }}" method="post">
                                             @csrf
                                             @method('delete')
                                             <button class="btn btn-sm btn-danger position-absolute bottom-0 end-0"><i class="bi bi-trash3-fill"></i></button>
                                         </form>
                                     </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <lebal class="form-label">Post Photos</lebal>
                                <input type="file" form="postUpdateForm"  name="photos[]" multiple class="form-control @error('photos') is-invalid @enderror @error("photos.*") is-invalid @enderror me-2">
                                @error('photos') <small class="d-inline-block">{{ $message }}</small> @enderror
                                @error("photos.*") <small class="d-inline-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea type="text" form="postUpdateForm" name="description" class="form-control @error('description') is-invalid @enderror"  rows="10" >{{ old('description',$post->description) }}</textarea>
                                @error('description') <small>{{ $message }}</small> @enderror

                            </div>
                            <div class="d-flex align-items-end">

                                <div class=" ">
                                    @if(isset($post->featured_image))
                                        <div class="mt-2 ">
                                            <img class="w-25" class="rounded-3" src="{{ asset('storage/'.$post->featured_image) }}" alt="">
                                        </div>
                                    @endif
                                    <input type="file" form="postUpdateForm" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror me-2">
                                    @error('featured_image') <small class="d-inline-block">{{ $message }}</small> @enderror
                                </div>

                                <div class=" ps-3 ">
                                    <button form="postUpdateForm" class="btn btn-primary ">
                                        Update Post
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

