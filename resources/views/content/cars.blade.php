@section('cars')
    {{--@php
    echo '<pre>';
    print_r($cars);
    echo '</pre>';
    @endphp--}}
    @foreach($cars as $car => $val)
        {{--@if((float) filter_var($val[2], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) > 0)
        <p>{{ $car . ' ' . $val[0] . ' ' . (float) filter_var( $val[2], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) }}</p>
        @endif--}}
        <p>{{ $car . ' ' . $val[0] . ' ' . (float) filter_var( $val[2], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) }}</p>
    @endforeach

@endsection
