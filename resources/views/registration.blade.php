@extends('main')

@section('content')

    <div class="row justify-content-center center-page w-100">
        <div class="col-md-4">
            <div class="card">
            <div class="card-header">Registration</div>
                <div class="card-body">
                    <form action="{{ route('sample.validate_registration') }}" method="POST" name="registerForm">
                        @csrf
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="username" placeholder="Username">
                            @if($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="email" placeholder="Email">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="first_name" placeholder="First name">
                            @if($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="last_name" placeholder="Last name">
                            @if($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="phone" onsubmit="return checkForm()" placeholder="Phone number">
                            @if($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="password" name="password" placeholder="Password">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm password">
                            @if($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <select id="country-dd" class="form-control" name="country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $data)
                                    <option value="{{$data->id}}">
                                        {{$data->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select id="state-dd" class="form-control" name="state">
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select id="city-dd" class="form-control" name="city">
                            </select>
                        </div>
                        <button class="btn btn-outline-primary w-100" type="submit">Register me</button>
                    </form>
                    <div class="col-md-12 d-flex justify-content-center">
                        <a class="link-primary" href="{{ route('login') }}">Have you got an account? Sign in!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
