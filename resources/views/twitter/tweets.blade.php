@extends('main')

@section('content')

{{--{{ dd($tweets) }}--}}
<div class="card">
    <div class="d-flex card-header justify-content-center">{{ __('dashboard.posts') }}</div>

    @if(empty($tweets->errors))
    @foreach($tweets as $row)
        <div class="row row-cols-1 g-3">
            <div class="card-body">
                <div class="row row-cols-1 g-3" id="all_comments">
                    <div class="col" id="post-{{ $row->id }}">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="card-text" id="card-text-{{ $row->id }}">{{ $row->text }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <small class="text-muted">{{  $row->user->name }}</small>
                                    </div>
                                    <small class="text-muted">{{ date('d F Y G:i', strtotime($row->created_at)) }}</small>
                                    <img src="{{ $row->user->profile_image_url_https }}" width="50px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @else
        <h1>Something went wrong!</h1>
    @endif
</div>
@endsection
