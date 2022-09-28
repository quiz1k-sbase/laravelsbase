@extends('main')

@section('content')
    @csrf
    <select class="form-select mb-2" aria-label="Default select example" id="car">
        <option selected>Select car</option>
        <option value="bmw" id="9">BMW</option>
        <option value="subaru" id="75">Subaru</option>
        <option value="vaz" id="88">ВАЗ</option>
    </select>
    <select class="form-select mb-2" aria-label="Default select example" id="model"
            data-url="{{ route('autoria.getModel') }}">Select model</select>
    <label class="">Engine: </label>
    <div class="d-flex w-25">
        <input type="number" class="form-control" placeholder="From 0.0" id="engine" name="engine">
        <input type="number" class="form-control" placeholder="To 0.0" id="engineL" name="engineL">
    </div>
    <label class="">Year: </label>
    <div class="d-flex w-25">
        <select class="form-select mb-2" aria-label="Default select example" id="yearG">
            <option value="0" selected>From</option>
            @for($i = 2022; $i >= 1900; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <select class="form-select mb-2" aria-label="Default select example" id="yearL">
            <option value="0" selected>To</option>
            @for($i = 2022; $i >= 1900; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <button type="submit" class="btn btn-primary" data-url="{{ route('autoria.car') }}"
    onclick="searchCar()">Search</button>

    <div id="allCars">

    </div>

@endsection
