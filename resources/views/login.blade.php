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
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form action="{{ route('sample.validate_login') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="email" placeholder="Email">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="password" name="password" placeholder="Password">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <button class="btn btn-outline-primary w-100" type="submit">Log in</button>
                    </form>
                    <div class="col-md-12 d-flex justify-content-center">
                        <a class="link-primary" href="{{ route('registration') }}">Registration</a>
                    </div>
                </div>
        </div>
    </div>


@endsection('content')
