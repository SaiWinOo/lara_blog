@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
        @include('sidebar')
        <div class="col-9">
            <div class="card">
                <div class="card-body">

                    <div class="gallery">
                        @forelse(\Illuminate\Support\Facades\Auth::user()->photos as $photo)
                            <img class="w-100 mb-3 rounded-3" src="{{ asset('storage/'.$photo->name)  }}" alt="">
                        @empty
                        @endforelse
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
