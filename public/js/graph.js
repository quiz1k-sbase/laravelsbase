$(document).ready(function (){
   $("#sendDate").on('click', function () {
       check_csrf();
       let dateFrom = $('#selectDateFrom').val();
       let dateTo = $('#selectDateTo').val();
       let url = $("#selectDate").data('url');
       $.ajax({
           type: 'POST',
           url: url,
           data: {
              dateFrom: dateFrom,
              dateTo: dateTo
           },
           success: function (data) {
               setData(data);
           }
       });
   });
});

function setData(date) {

    let labels = [
    ];
    var start = new Date(date.date.dateFrom);
    var end = new Date(date.date.dateTo);


    var loop = new Date(start);
    while(loop <= end){
        labels.push(loop.toISOString().split('T')[0]);

        var newDate = loop.setDate(loop.getDate() + 1);
        loop = new Date(newDate);
    }

    let arrPosts = date.posts;
    let arrComments = date.comments;
    let arrUsers = date.users;
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'New posts',
                backgroundColor: 'rgb(9,213,0)',
                borderColor: 'rgb(0,152,0)',
                data: arrPosts,
                parsing: {
                    xAxisKey: 'day',
                    yAxisKey: 'post_count'
                }
            },
            {
                label: 'New comments',
                backgroundColor: 'rgb(0,69,239)',
                borderColor: 'rgb(0,47,169)',
                data: arrComments,
                parsing: {
                    xAxisKey: 'day',
                    yAxisKey: 'comment_count'
                }
            },
            {
                label: 'Users',
                backgroundColor: 'rgb(241,0,0)',
                borderColor: 'rgb(182,0,0)',
                data: arrUsers,
                parsing: {
                    xAxisKey: 'day',
                    yAxisKey: 'user_count'
                }
            },
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };

    console.log(data);

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
}
