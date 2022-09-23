@extends('main')

@section('content')
        <nav class="navbar navbar-light navbar-expand-lg mb-5">
            <div class="container">
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Add post-->
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="d-flex col-lg-6 col-md-8 mx-auto flex-column flex-wrap align-content-center justify-content-center">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
                    <label class="form-label">Input your post:</label><br>
                    <textarea class="form-control w-100" type="text" name="text" rows="3" id="text"></textarea>
                    @if($errors->has('text'))
                        <span class="text-danger">{{ $errors->first('text') }}</span>
                    @endif
                    <button class="btn btn-outline-primary w-100 mt-2" type="submit" onclick="addPost()"
                            data-url="{{ route('post.store') }}" id="submitButton">Add</button>
                </div>
            </div>
        </section>

        <!--All posts view-->
        <div class="card">
            <div class="d-flex card-header justify-content-center">Posts:</div>
            <div class="card-body">
                <div class="row row-cols-1 g-3" id="all_comments">
                @if(count($dataPost) > 0)

                    @foreach($dataPost as $row)
                        <div class="col" id="post-{{ $row->id }}">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="card-text" id="card-text-{{ $row->id }}">{{ $row->text }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <small class="text-muted">{{  $row->username }}</small>
                                            <!--TODO create normal username output-->
                                        </div>
                                        <small class="text-muted">{{ date('d F Y G:i', strtotime($row->created_at)) }}</small>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" id="add-{{ $row->id }}"
                                                data-url="{{ route('comment.addComment') }}" onclick="getId({{ $row->id }})">
                                            Add comment
                                        </button>
                                        @if(Auth::user()->id === $row->user_id || Auth::user()->role_as == '1')
                                            <button type='button' class='btn btn-warning' data-bs-toggle='modal'
                                                    data-bs-target='#editPost' onclick='getId({{ $row->id }})'
                                                    data-url="{{ route('post.update') }}"
                                                    id="edit-{{ $row->id }}">Edit</button>
                                            <button type='button' class='btn btn-danger' onclick='deletePost({{ $row->id }})'
                                                    data-url="{{ route('post.destroy', $row->id) }}"
                                                    id="delete-{{ $row->id }}">Delete</button>
                                        @endif
                                    </div>
                                    <div class="container g-3" id="commentsContainer-{{ $row->id }}">
                                        @if(count($dataComment) > 0)
                                            @foreach($dataComment as $rowComm)
                                                @if($row->id === $rowComm->post_id)
                                                <div class="card w-50 mt-2" id="comment-{{ $rowComm->id }}">
                                                    <div class="card-body" id="commentBody">
                                                        <p class="card-text" id="comment-text-{{ $rowComm->id }}">{{ $rowComm->comment }}</p>
                                                        <small class="text-muted">{{ $rowComm->username }}</small>
                                                        <small class="text-muted">{{ date('d F Y G:i', strtotime($rowComm->created_at)) }}</small>
                                                        @if(Auth::user()->id === $rowComm->user_id  || Auth::user()->role_as == '1')
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                data-bs-target="#editComm" onclick="getId({{ $rowComm->id }})"
                                                                data-url="{{ route('comment.editComment') }}"
                                                                id="editComm-{{ $rowComm->id }}">Edit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="deleteComment({{ $rowComm->id }})"
                                                                id="deleteComm-{{ $rowComm->id }}"
                                                                data-url="{{ route('comment.destroy', $rowComm->id) }}">Delete</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <p class="card-text">No data found</p>
                @endif
                </div>
            </div>
        </div>

        <!--Popup add comment-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
                        <label class="form-label">Input your comment:</label><br>
                        <textarea class="form-control" type="text" name="comment" rows="3" id="comment"></textarea><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="addComment()">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment edit -->
        <div class="modal fade" id="editComm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change your comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Input new comment:</label><br>
                        <textarea class="form-control" type="text" name="comment" rows="3" id="editedComment"></textarea><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeEdit">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="editComment()">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post edit -->
        <div class="modal fade" id="editPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change your post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Input new comment:</label><br>
                        <textarea class="form-control" type="text" name="editedPost" rows="3" id="editedPost"></textarea><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeEditPost">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="editPost()">Add</button>
                    </div>
                </div>
            </div>
        </div>



@endsection('content')
