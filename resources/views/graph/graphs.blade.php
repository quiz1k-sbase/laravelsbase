@extends('main')

@section('content')
    <nav class="navbar navbar-light navbar-expand-lg mb-5">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav m-2">
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('logout') }}" >{{ __('dashboard.logout') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row w-75">
        <div class="mb-3">
            @csrf
            <label>Choose date</label>
            <input type="text" id="daterange_textbox" class="form-control" readonly>
            <button type="submit" id="sendDate" class="btn btn-primary" data-url="{{ route('graph.send') }}">Search</button>
        </div>
        <canvas id="myChart"></canvas>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
