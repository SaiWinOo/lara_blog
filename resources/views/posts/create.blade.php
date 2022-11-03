@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row ">
            @include('sidebar')
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4>Create Post</h4>
                        <hr>
                        <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" >
                                @error('title') <small>{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Select Category </label>
                                <select type="text"  name="category" class="form-select @error('category') is-invalid @enderror" >
                                    <option value="0" >Select Category</option>
                                @foreach(\App\Models\Category::all() as $category)
                                        <option {{ old('category') == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category') <small>{{ $message }}</small> @enderror

                            </div>
                            <div class="mb-3">
                                <lebal class="form-label">Post Photos</lebal>
                                <input type="file"   name="photos[]" multiple class="form-control @error('photos') is-invalid @enderror @error("photos.*") is-invalid @enderror me-2">
                                @error('photos') <small class="d-inline-block">{{ $message }}</small> @enderror
                                @error("photos.*") <small class="d-inline-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror"  rows="10" >{{ old('description') }}</textarea>
                                @error('description') <small>{{ $message }}</small> @enderror

                            </div>
                            <div class="d-flex justify-content-">
                                <div class="w-75">
                                    Featured image <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror me-2">
                                    @error('featured_image') <small class="d-inline-block">{{ $message }}</small> @enderror
                                </div>

                                <div class="w-25 ps-3 mt-4">
                                    <button class="btn btn-primary ">
                                        Add Post
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

