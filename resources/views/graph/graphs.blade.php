@extends('main')

@section('content')

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
