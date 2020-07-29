<?php include('server.php');
session_start();
$ownerFirstName = $_SESSION['ownerFirstName'];
$ownerLastName = $_SESSION['ownerLastName'];
$phoneNumber = $_SESSION['phoneNumber'];
$email = $_SESSION['email'];
$password =  $_SESSION['password'];

echo "<script type='text/javascript'>alert('Velkommen $ownerFirstName!')</script>";
include('head.php')
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Tilføj medarbejder</title>

        <style>
            .btn-success {
                margin-top: 4vh;
                margin-bottom: 3vh;
                font-family: 'Ubuntu', sans-serif;
                border-radius: 10px;
            }

            input,
            select {
                text-align: left;
            }
        </style>
    </head>

    <body>
      <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header"> <a class="navbar-brand" href="index.php">EveBnb</a> </div>

                <ul class="nav navbar-nav navbar-right" style="margin-right: 1vw;">
                  <?php if (isset($_SESSION['username'])) { ?>
                    <ul class="nav navbar-nav">
                        <li><a href="kundetjek.php">Tjek bestillinger</a></li>
                    </ul>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo ucfirst($_SESSION['username']); ?><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="update.php">Opdater oplysninger</a></li>
                        <li><a class="logud" href="index.php?logout='1'" style="width:100%;">Log ud</a></li>
                      </ul>
                    </li>
                  <?php } else { ?>
                    <ul class="nav navbar-nav">
                        <li><a href="register.php">Opret bruger</a></li>
                        <li><a class="active" href="addVenue.php">Opret venue</a></li>
                    </ul>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Log ind<span class="caret"></span></a>
                      <ul class="dropdown-menu" style="width: 10vw;">
                        <form class="form-horizontal" method="post" action="index.php" accept-charset="UTF-8">
                            <input class="form-control login" type="text" name="email" placeholder="E-mail">
                            <input class="form-control login" type="password" name="password" placeholder="adgangskode">
                            <div class="col-sm-6">
                            <button type="submit" class="btn btn-success " name="login_user">Log ind</button>
                            </div>
                            <div class="col-sm-6">
                            <a href="forgot.php">Glemt kode?</a>
                            </div>


                        </form>
                      </ul>
                    </li>
                    <?php
                  } ?>
                </ul>
            </div>
        </nav>
      </header>
        <div class="content">
            <div class="con row">
                <h3>Tilføj medarbejder</h3> </div>
              <div class="" style="grid-column:1/3;">
                <?php include('errors.php'); ?>
                  <?php echo isset($msg)?$msg:"";?>
              </div>
              <form class="" action="addVenue.php" method="post">
                   <div class="venueInfo">
                     <div class="input-group row">
                     <label>Venue navn</label>
                     <input type="text" name="venueName"> </div>
                     <div class="input-group row">
                     <label>Kategori</label>
                     <select class="" name="venueCategory">
                       <option value="lokale">Event lokale</option>
                       <option value="salon">Salon</option>
                     </select> </div>
                     <div class="input-group row">
                     <label>Post nummer</label>
                     <input type="text" name="zipCode"> </div>
                     <div class="input-group row">
                     <label>Beskrivelse</label>
                     <textarea name="venueDescription" rows="6" ></textarea> </div>
                     <div class="input-group row">
                     <label>Pris pr dag</label>
                     <input type="text" name="venuePrice"> </div>
                     <div class="input-group row">
                     <label>Adresse</label>
                     <input type="text" name="venueAdress" id="my-address">
                      <a class="btn btn-primary" onclick="codeAddress()">Se på Maps</a>  </div>
                     <input type="hidden" name="lng" id="my-lng">
                     <input type="hidden" name="lat" id="my-lat">

                   </div>
                    <div class="input-group" style="grid-column: 1/3; margin:auto;">
                        <button type="submit" class="btn btn-success" name="reg_Venue">Opret</button>
                    </div>
                        </form>
        </div>
        <div class="modal" id="myModal">
           <div class="modal-dialog">
             <div class="modal-content">

               <!-- Modal Header -->
               <div class="modal-header">
                 <h4 class="modal-title">Er dette korrekt?</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>

               <!-- Modal body -->
               <div class="modal-body">
                 <div id="map"></div>
               </div>

               <!-- Modal footer -->
               <div class="modal-footer">
                 <button type="button" id="close" class="btn btn-danger" data-dismiss="modal">Luk</button>
               </div>

             </div>
           </div>
         </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByLegMt5J-J4SNXCU_vHNOZorcVPsmf_4&libraries=places"></script>
<script type="text/javascript">
var modal = document.getElementById("myModal");

var latt;
var lngg;

function setCoords(latt,lngg){
  this.latt = latt;
  this.lngg = lngg;
}

function initMap() {
  var uluru = {
  lat : latt,
  lng : lngg
}
modal.style.display = "block";
console.log("Adressen siger: "+ latt + lngg);
var map = new google.maps.Map(
    document.getElementById('map'), {
        zoom: 15,
        center: uluru
    });
// The marker, positioned at Uluru
var marker = new google.maps.Marker({
    position: uluru,
    map: map
});
}
//luk modal ved klik udenfor img
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
var closeButton = document.getElementsByClassName("close")[0];
var closeLink = document.getElementById("close");

// When the user clicks on <span> (x), close the modal
closeButton.onclick = function() {
  modal.style.display = "none";
}
closeLink.onclick = function() {
  modal.style.display = "none";
}
function initialize() {
var address = (document.getElementById('my-address'));
var autocomplete = new google.maps.places.Autocomplete(address);
autocomplete.setTypes(['geocode']);
google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
        return;
    }

var address = '';
if (place.address_components) {
    address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
}
});
}

function codeAddress() {
   geocoder = new google.maps.Geocoder();
   var address = document.getElementById("my-address").value;
   geocoder.geocode( { 'address': address}, function(results, status) {
     if (status == google.maps.GeocoderStatus.OK) {

       lngg = results[0].geometry.location.lng();
       latt = results[0].geometry.location.lat();
       alert("Latitude: "+latt);
       alert("Longitude: "+lngg);

        $("#my-lat").val(latt);
        $("#my-lng").val(lngg);
         initMap();
     }

     else {
       alert("Geocode was not successful for the following reason: " + status);
     }
   });
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>
    </body>

    </html>
