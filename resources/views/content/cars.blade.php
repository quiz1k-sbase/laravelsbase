@section('cars')
    <div class="row d-flex justify-content-evenly">
    @foreach($cars as $car => $val)
        @if(count($val))
            <div class="card me-3 mb-3 p-0" style="width: 18rem; overflow: hidden">
                <img src="{{ $val['img'] }}" style="width: 300px; height: 250px; object-fit: cover;" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $val['title'] }}</h5>
                    <span class="price">{{ $val['price'] }}$</span>
               </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Odometer: {{ $val['description'][0] }}</li>
                    <li class="list-group-item">Place: {{ $val['description'][1] }}</li>
                    <li class="list-group-item">Engine: {{ $val['description'][2] }}</li>
                    <li class="list-group-item">Transmission: {{ $val['description'][3] }}</li>
                </ul>
                <div class="card-body">
                    <a href="{{ $val['href'] }}" class="card-link" target="_blank">Link</a>
                    <div class="autoria-vin">
                        {!! $val['vin'] !!}
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    </div>

@endsection
{{ asset('css/style.css') }}
