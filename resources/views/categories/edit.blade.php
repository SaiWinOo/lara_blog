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
                        <form action="{{ route("category.update",$category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{ $category->title }}" name="title" class="form-control">
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary">
                                        Update Category
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
