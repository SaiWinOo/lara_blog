@extends('layouts.app')
@vite( 'resources/js/app.js')
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
                                    <li class="breadcrumb-item active" aria-current="page">Category List</li>
                                </ol>
                            </nav>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    @notAuthor
                                    <th>Owner</th>
                                    <th>Post Count</th>
                                    @endnotAuthor
                                    <th>Controls</th>
                                    <th>created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td class="">{{ $category->title }} <br>
                                            <small class="bg-secondary rounded-3 text-white px-2 ">{{ $category->slug }}</small>
                                        </td>
                                        @notAuthor
                                        <td>
                                            {{ $category->user->name }}
                                        </td>
                                        @endnotAuthor
                                        <td>
                                            {{ $category->posts()->count() }}
                                        </td>
                                        <td>
                                            @can('update',$category)
                                            <a class="btn btn-outline-warning btn-sm" href="{{ route('category.edit',$category->id) }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            @endcan
                                            @can('delete',$category)
                                            <form action="{{ route('category.destroy',$category->id) }}" class="d-inline-block" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                                @endcan
                                        </td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                    </tr>
{{--                                @empty--}}
{{--                                    <p>There's no category!</p>--}}
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

