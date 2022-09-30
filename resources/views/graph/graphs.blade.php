@extends('main')

<div class="row w-50">
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [
        @for($i = 1; $i < 32; $i++)
            {{ $i }},
        @endfor
    ];

    const data = {
        labels: labels,
        datasets: [
            {
                label: 'New posts',
                backgroundColor: 'rgb(9,213,0)',
                borderColor: 'rgb(0,152,0)',
                data: [
                    @foreach($posts as $val => $value)
                        {{ '{' . 'day' . ':' . $val . ',' . 'val' . ':' . $value . '}' }},
                     @endforeach
                ]
            },
            {
                label: 'New comments',
                backgroundColor: 'rgb(0,69,239)',
                borderColor: 'rgb(0,47,169)',
                data: [
                    @foreach($comments as $val => $value)
                        {{ '{' . 'day' . ':' . $val . ',' . 'val' . ':' . $value . '}' }},
                    @endforeach
                ],
            },
            {
                label: 'Users',
                backgroundColor: 'rgb(241,0,0)',
                borderColor: 'rgb(182,0,0)',
                data: [
                    @foreach($users as $val => $value)
                        {{ '{' . 'day' . ':' . $val . ',' . 'val' . ':' . $value . '}' }},
                    @endforeach
                ],
            },
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            parsing: {
                xAxisKey: 'day',
                yAxisKey: 'val'
            }
        }
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
