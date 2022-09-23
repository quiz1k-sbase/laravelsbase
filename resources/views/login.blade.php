@extends('main')

@section('content')

    <div class="row justify-content-center center-page w-100">
        <div class="col-md-4">
            <div class="card">
                @if($message = Session::get('success'))

                    <div class="alert alert-info">
                        {{ $message }}
                    </div>
                @endif
                <div class="card-header">{{ __('dashboard.login') }}</div>
                <div class="card-body">
                    <form action="{{ route('sample.validate_login') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="email" placeholder="{{ __('dashboard.email') }}">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="password" name="password" placeholder="{{ __('dashboard.password') }}">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <button class="btn btn-outline-primary w-100" type="submit">{{ __('dashboard.log-in') }}</button>
                    </form>
                    <div class="col-md-12 d-flex justify-content-evenly">
                        <a class="link-primary" href="{{ route('registration') }}">{{ __('dashboard.registration') }}</a>
                        <a class="link-primary" href="/forgot-password">{{ __('dashboard.resetPassword') }}</a>
                    </div>
                </div>
        </div>
    </div>


@endsection('content')
