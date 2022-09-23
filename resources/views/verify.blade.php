@extends('main')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('dashboard.verifyEmail') }}</div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('dashboard.verifySend') }}
                            </div>
                        @endif
                        <a class="btn btn-primary btn-lg" href="http://laravelsite.loc/{{$token}}/reset-password">{{ __('dashboard.clickHere') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
