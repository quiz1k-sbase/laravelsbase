@extends('main')

<div class="row w-50">
    <div class="mb-3">
        @csrf
        <label>Choose date from</label>
        <input class="form-control" type="date" id="selectDateFrom">
        <label>Choose date to</label>
        <input class="form-control" type="date" id="selectDateTo">
        <button type="submit" id="sendDate" class="btn btn-primary" data-url="{{ route('graph.send') }}">Search</button>
    </div>
    <canvas id="myChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
