<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">

    var x = document.getElementById("user-coords");

    window.onload = getLocation();


    function loading() {
        x.innerHTML = "Loading..."
    }

    function getLocation() {
        // loading();

        var crd;
        var geoSuccess = function (pos) {
            crd = {'coords': [pos.coords.latitude, pos.coords.longitude]};

            $.post($("#frmRegister").attr("action"),
                $("#currentPos").val(JSON.stringify(crd)));
        };
        var geoError = function(error) {
            console.log('Error occurred. Error code: ' + error.code);
        };

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
        }
        else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    // function showPosition(position) {
    //     x.innerHTML = "Latitude: " + position.coords.latitude +
    //         "<br>Longitude: " + position.coords.longitude;
    // }


</script>