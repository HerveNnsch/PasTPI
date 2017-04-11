<!DOCTYPE html>
<?php
$getCoordonée = curl_init("https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyCAEkv33ltVdDj2PWlspis4tGUNOsScego")
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Google map</title>
    </head>
    <body>

        <h1>My First Google Map</h1>

        <div id="googleMap" style="width:50%;height:400px;"></div>

        <script>
            function myMap() {
                var mapProp = {
                    center: new google.maps.LatLng(51.508742, -0.120850),
                    zoom: 12,
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                var myCenter = new google.maps.LatLng(51.508742, -0.120850);
                var marker = new google.maps.Marker({position: myCenter});
                marker.setMap(map);
                google.maps.event.addListener(marker, 'mouseover', function () {//le over c'est bien mais sa en crée un nouveau a chaque fois
                    var infowindow = new google.maps.InfoWindow({
                        content: "Hello World!"
                    });
                    infowindow.open(map, marker);
                });
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAEkv33ltVdDj2PWlspis4tGUNOsScego&callback=myMap"></script>
    </body>
</html>
