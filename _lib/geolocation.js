var geoStatus = document.getElementById("geoStatus");

window.onload = function () { getLocation(); };

function getLocation() {
    var geoSuccess = function (pos) {
        var coord = {'coords': [pos.coords.latitude, pos.coords.longitude]};

        $.post($("#frmRegister").attr("action"),
            $("#currentPos").val(JSON.stringify(coord)));
    };
    var geoError = function(error) {
        console.log('An error occurred. Error code: ' + error.code);
    };

    if (navigator.geolocation)
        navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
    else
        geoStatus.innerHTML = "Geolocation is not supported by this browser.";
}