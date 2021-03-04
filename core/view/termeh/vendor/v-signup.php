<?php

    $this->data['PAGE']['demo']=0;

    $this->data['PAGE']['title'] = 'Vendor SignUp';
    $this->data['PAGE']['keywords'] = 'test';
    $this->data['PAGE']['description'] = 'test';
    $this->data['PAGE']['robots'] = 1; // Null = Follow
    $this->data['PAGE']['image'] = 'test';
    $this->data['PAGE']['canonical'] = APP_URL;
    $this->data['PAGE']['path'] = $this->page_path;
    $this->data['PAGE']['amphtml'] = NULL;
    $this->data['PAGE']['feed'] = NULL;

    $this->data['PAGE']['head'] = ' ';

    if ($_SESSION['M']['user'] ?? false) {
        header('Location: home');
        return 0;
    }

    include_once $this->PATH."global/head.php";
    include_once $this->PATH."global/header.php";
?>

<main role="main" class="container">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">SignUp</div>
                    <div class="card-body">
                        <?php if ($this->data['activate']) { ?>
                            <?php if($this->data['active']) { ?>
                                <div class="alert alert-success">Your Account has been active, Now you can enjoy it...
                                <br>
                                <a href="../../../../index.php">Try SignIn</a>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger">Your Account has been not active, this link is expired/wrong!</div>
                            <?php } ?>
                        <?php } else { ?>
                        <form id="signup" class="form-horizontal" method="post" action="vendor/signup">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" minlength="3" name="fname" id="fname" placeholder="Enter your First Name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" minlength="3" name="lname" id="lname" placeholder="Enter your Last Name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                                </div>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" class="form-control"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" id="password" placeholder="Enter your Password" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm your Password" required>
                            </div>
                            <h6 class="">Location</h6>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="lat" id="lat" value="41.0566498">
                                <input type="hidden" class="form-control" name="lng" id="lng" value="28.9877828">
                                <div id="map"></div>
                                <textarea class="form-control" name="address" id="address" readonly></textarea><br>
                                <textarea class="form-control" name="address2" id="address2" placeholder="Address 2"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-lg col-8 login-button">SignUp</button>
                                <small class="mx-3 text-muted border border-secondary rounded-circle p-1">OR</small>
                                <a class="btn btn-sm btn-outline-info mx-auto" href="../../../../index.php">SignIn</a>
                            </div>
                        </form>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

    <script>
        function myMap() {
            var mapProp= {
                center:new google.maps.LatLng(41.0566498,28,28.9877828),
                zoom:5,
            };

            var map = new google.maps.Map(document.getElementById("map"),mapProp);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChzvw9Iuai1856CHREmNvHAIwnHSHo5iM&callback=myMap"></script>


<script>

    var gurl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=41.0566498,28.9877828&key=AIzaSyChzvw9Iuai1856CHREmNvHAIwnHSHo5iM&callback';
    $.getJSON( gurl, function( data ) {
        let address = data.results[0].formatted_address;
        console.log(address);
        $('#address').val(address);
    });

    // function initMap() {
    //     const initialPosition = { lat: 59.325, lng: 18.069 };
    //     const map = new google.maps.Map(document.getElementById('map'), {
    //         center: initialPosition,
    //         zoom: 15
    //     });
    //     const marker = new google.maps.Marker({ map, position: initialPosition });
    //     // Get user's location
    //     if ('geolocation' in navigator) {
    //         navigator.geolocation.getCurrentPosition(
    //             position => {
    //                 console.log(`Lat: ${position.coords.latitude} Lng: ${position.coords.longitude}`);
    //                 $('#lat').val(position.coords.latitude);
    //                 $('#lon').val(position.coords.longitude);
    //                 // var gurl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&key=AIzaSyChzvw9Iuai1856CHREmNvHAIwnHSHo5iM&callback';
    //                 // $.getJSON( gurl, function( data ) {
    //                 //     let resp = JSON.parse(data);
    //                 //     console.log(resp);
    //                 // });
    //
    //
    //                 // Set marker's position.
    //                 marker.setPosition({
    //                     lat: position.coords.latitude,
    //                     lng: position.coords.longitude
    //                 });
    //                 // Center map to user's position.
    //                 map.panTo({
    //                     lat: position.coords.latitude,
    //                     lng: position.coords.longitude
    //                 });
    //             },
    //             err => alert(`Error (${err.code}): ${getPositionErrorMessage(err.code)}`)
    //         );
    //     } else {
    //         alert('Geolocation is not supported by your browser.');
    //     }
    // }

</script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChzvw9Iuai1856CHREmNvHAIwnHSHo5iM&callback=initMap&libraries=places"></script>-->

<script>
    //  Confirm password check
    $('#password, #confirm').on('keyup', function () {
        $('#confirm').removeClass('border-success border-danger');
        if ($('#password').val() == $('#confirm').val()) {
            $('#confirm').addClass('border border-success');
        } else
            $('#confirm').addClass('border border-danger');
    });

    //  signUp
    $('body').on('submit','form#signup', function(event){
        event.preventDefault();
        if (($('#password').val() == $('#confirm').val()) && ($('#password').val().length > 5) ) {
            const data = $(this).serialize();
            const classA = $(this).attr('action');
            ajaxCall (classA, data,function(response) {
                let obj = JSON.parse(response);
                $('form#signup').fadeOut();
                $('form#signup').html('<p class="small text-muted"><i class="text-success fa fa-check"></i> Account created,<br> Now check your mail (also spam box) for a link to activate your password.</p>');
                $('form#signup').fadeIn();
            });
        } else {
            notify('Confirm password is not same as password','error',false);
        }
    });
</script>

<?php include_once $this->PATH."global/footer.php"; ?>