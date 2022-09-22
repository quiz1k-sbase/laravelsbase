$(document).ready(function () {
    $('#country-dd').on('change', function () {
        let csrf = check_csrf();
        var idCountry = this.value;
        let url = 'api/fetch-states';
        $("#state-dd").html('');
        $.ajax({
            url: url,
            type: "POST",
            data: {
                country_id: idCountry,
                _token: csrf
            },
            dataType: 'json',
            success: function (result) {
                $('#state-dd').html('<option value="">Select State</option>');
                $.each(result.states, function (key, value) {
                    $("#state-dd").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
                $('#city-dd').html('<option value="">Select City</option>');
            }
        });
    });
    $('#state-dd').on('change', function () {
        let csrf = check_csrf();
        var idState = this.value;
        let url = 'api/fetch-cities';
        $("#city-dd").html('');
        $.ajax({
            url: url,
            type: "POST",
            data: {
                state_id: idState,
                _token: csrf
            },
            dataType: 'json',
            success: function (res) {
                $('#city-dd').html('<option value="">Select City</option>');
                $.each(res.cities, function (key, value) {
                    $("#city-dd").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
});
