function searchCar()
{
    check_csrf();
    let car = $("#car").val();
    let id_car = $("#car").children(":selected").attr('id');
    let model = $("#model").val();
    let id_model = $("#model").children(":selected").attr('id');
    let engine = $("#engine").val();
    let engineL = $("#engineL").val();
    let yearG = $("#yearG").val();
    let yearL = $("#yearL").val();
    if (yearL < yearG) {
        let x = yearG;
        yearG = yearL;
        yearL = x;
    }
    let url = $("#url").data('url');
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            car: car,
            model: model,
            engine: engine,
            engineL: engineL,
            id_car: id_car,
            id_model: id_model,
            yearG: yearG,
            yearL: yearL,
        },
        success: function (data) {
            $('#allCars').html(data.html);
            $('#yearG').val(yearG);
            $('#yearL').val(yearL);
        }
    })

}


$(document).ready(function () {
    $('#car').on('change', function () {
        check_csrf();
        let car = $('#car').val();
        let url = $("#model").data('url');
        $('#model').html('');
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                car: car,
            },
            success: function (data) {
                $('#model').html('<option value="">Select model</option>');
                console.log(data);
                $.each(data, function (key, value) {
                    $("#model").append('<option value="' + key.toLowerCase() + '" id="'+ value.id +'">' + key + '</option>');
                })
            }
        });
    });

});
