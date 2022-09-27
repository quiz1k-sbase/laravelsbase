@extends('main')

@section('content')

    <section class="vh-100">
        <div class="container py-5 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4">

                    <div class="card" style="color: #4B515D; border-radius: 35px;">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <h6 class="flex-grow-1">{{ ucfirst($currentWeather['name']) }}</h6>
                                <h6>{{ ucfirst(\Carbon\Carbon::createFromTimestamp($currentWeather['dt'])->format('l')) }}</h6>
                            </div>

                            <div class="d-flex flex-column text-center mt-5 mb-4">
                                <h6 class="display-4 mb-0 font-weight-bold" style="color: #1C2331;"> {{ round($currentWeather['main']['temp']) }}°C </h6>
                                <span class="small" style="color: #868B94">{{ ucfirst($currentWeather['weather'][0]['description']) }}</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1" style="font-size: 1rem;">
                                    <div><i class="fas fa-sun fa-fw" style="color: #868B94;"></i> <span class="ms-1"> Feels like: {{ round($currentWeather['main']['feels_like']) }}°C </span>
                                    </div>
                                    <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> Wind: {{ round($currentWeather['wind']['speed']) }} km/h</span>
                                    </div>
                                    <div><i class="fas fa-tint fa-fw" style="color: #868B94;"></i> <span class="ms-1"> Clouds" {{ round($currentWeather['clouds']['all']) }}% </span>
                                    </div>
                                </div>
                                <div>
                                    <img src="http://openweathermap.org/img/wn/{{ $currentWeather['weather'][0]['icon'] }}@2x.png"
                                         width="100px">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

