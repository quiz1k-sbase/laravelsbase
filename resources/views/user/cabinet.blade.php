@extends('main')

@section('content')

    <section class="center-page w-75">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ Auth::user()->image }}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                            <h5 class="my-3">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h5>
                            <div class="mb-3">
                                <input class="form-control form-control-sm w-50 me-auto ms-auto" id="addProfilePhoto" type="file" name="addProfilePhoto">
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <button class="btn btn-primary" data-url="{{ route('addProfilePhoto') }}" onclick="addProfilePhoto()"
                                        id="profilePhoto">Add photo</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0" id="name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
                                    <p class="text-muted mb-0">
                                        <a class="link" data-bs-target='#changeName' data-bs-toggle='modal'
                                           id="changeNameButton" data-url="{{ route('changeName') }}">{{ __('dashboard.changeName') }}</a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0" id="email-text">{{ Auth::user()->email }}</p>
                                    <p class="text-muted mb-0">
                                        <a class="link" data-bs-target='#changeEmail' data-bs-toggle='modal'
                                        id="changeEmailButton" data-url="{{ route('changeEmail') }}">Change E-mail</a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->phone }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><a href="{{ route('forgotPassword') }}">Change password</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Popup change email-->
    <div class="modal fade" id="changeEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.changeEmail') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
                    <label class="form-label">{{ __('dashboard.inputOldEmail') }}</label><br>
                    <input class="form-control" type="text" name="commentReply" id="oldEmail"><br>
                    <label class="form-label">{{ __('dashboard.inputNewEmail') }}</label><br>
                    <input class="form-control" type="text" name="commentReply" id="newEmail"><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalChangeEmail">{{ __('dashboard.close-button') }}</button>
                    <button type="submit" class="btn btn-primary" onclick="changeEmail()">{{ __('dashboard.changeEmail') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!--Popup change name-->
    <div class="modal fade" id="changeName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.changeName') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
                    <label class="form-label">{{ __('dashboard.inputOldFirstName') }}</label><br>
                    <input class="form-control" type="text" name="commentReply" id="oldFirstName"><br>
                    <label class="form-label">{{ __('dashboard.inputNewFirstName') }}</label><br>
                    <input class="form-control" type="text" name="commentReply" id="newFirstName"><br>
                    <label class="form-label">{{ __('dashboard.inputOldLastName') }}</label><br>
                    <input class="form-control" type="text" name="commentReply" id="oldLastName"><br>
                    <label class="form-label">{{ __('dashboard.inputNewLastName') }}</label><br>
                    <input class="form-control" type="text" name="commentReply" id="newLastName"><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalChangeName">{{ __('dashboard.close-button') }}</button>
                    <button type="submit" class="btn btn-primary" onclick="changeName()">{{ __('dashboard.changeName') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
