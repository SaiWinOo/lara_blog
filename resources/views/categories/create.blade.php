@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row ">
            @include('sidebar')
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4>Create Category</h4>
                        <hr>
                        <form action="{{ route('category.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror ">
                                    @error('title')
                                    <span class="invalid-feedback" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary">
                                        Add Category
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
