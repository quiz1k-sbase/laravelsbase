@section('postContent')
    <div class="col" id="post-{{ $responsePostArray['id'] }}">
        <div class="card shadow-sm">
            <div class="card-body">
                <p class="card-text" id="card-text-{{ $responsePostArray['id'] }}">{{ $responsePostArray['text'] }}</p>
                @if($responsePostArray['image'])
                    <img src="{{ $responsePostArray['image']  }}" class="photo">
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <small class="text-muted me-2">{{  $responsePostArray['uName'] }} </small>
                        <span class="text-success"> {{ __('dashboard.online') }}</span>
                    </div>
                    <small class="text-muted">{{ $responsePostArray['date'] }}</small>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" id="add-{{ $responsePostArray['id'] }}"
                            data-url="{{ route('comment.addComment') }}" onclick="getId({{ $responsePostArray['id'] }})">
                        {{ __('dashboard.addComment') }}
                    </button>
                        <button type='button' class='btn btn-warning' data-bs-toggle='modal'
                                data-bs-target='#editPost' onclick='getId({{ $responsePostArray['id'] }})'
                                data-url="{{ route('post.update') }}"
                                id="edit-{{ $responsePostArray['id'] }}">{{ __('dashboard.edit-button') }}</button>
                        <button type='button' class='btn btn-danger' onclick='deletePost({{ $responsePostArray['id'] }})'
                                data-url="{{ route('post.destroy', $responsePostArray['id']) }}"
                                id="delete-{{ $responsePostArray['id'] }}">{{ __('dashboard.delete-button') }}</button>
                </div>
                <div class="container g-3" id="commentsContainer-{{ $responsePostArray['id'] }}">
                </div>
            </div>
        </div>
    </div>
@endsection
