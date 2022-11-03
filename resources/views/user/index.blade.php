@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row ">
            @include('sidebar')
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4>Post List</h4>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="">
                                @if(request('keyword'))
                                    <span>Search results for <strong>"{{ request('keyword') }}"</strong> </span>
                                    <a class="ms-3" href="{{ route('user.index') }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                @endif
                            </div>
                            <form action="{{ route('user.index') }}"  method="get">
                                <div class="input-group">
                                    <input type="text"  class="form-control" name="keyword">
                                    <button class="btn btn-primary">
                                        <i class="bi bi-search"></i>
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>role</th>
                                <th>Controls</th>
                                <th>created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td class="w-25">{{ $user->name }}
                                    </td>
                                    <td> {{ $user->email }} </td>
                                    <td>{{ $user->role }}</td>
                                    <td class="text-nowrap text-center">
                                        <a class="btn btn-outline-info btn-sm" href="{{ route('user.show',$user->id) }}">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
                                        @can('update',$user)
                                            <a class="btn btn-outline-warning btn-sm" href="{{ route('user.edit',$user->id) }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan
                                        @can('delete',$user)
                                            <form action="{{ route('user.destroy',$user->id) }}" class="d-inline-block" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                    <td>
                                        <p class="small mb-0 text-black-50">
                                            <i class="bi bi-calendar-check-fill"></i>
                                            {{ $user->created_at->format('d M Y') }}
                                        </p>
                                        <p class="small mb-0 text-black-50">
                                            <i class="bi bi-clock"></i>
                                            {{ $user->created_at->format('h:i A') }}
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">There's no user</td>
                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $users->links() }}
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
