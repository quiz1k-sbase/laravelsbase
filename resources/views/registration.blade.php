@extends('main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
            <div class="card-header">Registration</div>
                <div class="card-body">
                    <form action="{{ route('sample.validate_registration') }}" method="POST" name="registerForm">
                        @csrf
                        <div class="form-group mb-2">
                            <input class="form-control" type="text" name="username" placeholder="Username"><br>
                            @if($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <input class="form-control" type="text" name="email" placeholder="Email"><br>
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <input class="form-control" type="text" name="first_name" placeholder="First name"><br>
                            @if($errors->has('firstName'))
                                <span class="text-danger">{{ $errors->first('firstName') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <input class="form-control" type="text" name="last_name" placeholder="Last name"><br>
                            @if($errors->has('lastName'))
                                <span class="text-danger">{{ $errors->first('lastName') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <input class="form-control" type="text" name="phone" onsubmit="return checkForm()" placeholder="Phone number"><br>
                            @if($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm password"><br>
                            @if($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                        <button class="btn btn-outline-primary w-100" type="submit">Register me</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection('content')
