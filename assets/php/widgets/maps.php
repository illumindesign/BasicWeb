<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * maps.php - Google Maps Widget
 *
 * February 2018
 */
?>
<style>
    .mapWidget
    {
        position:relative;
        -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        padding: 0;
        margin: 0;
        border:1px solid #fff;
        width:100%;
        height:200px;
        text-align: center;
    }
    .mapWidget:before, .mapWidget:after
    {
        content:"";
        position:absolute;
        z-index:-1;
        -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
        -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
        box-shadow:0 0 20px rgba(0,0,0,0.8);
        top:50%;
        bottom:0;
        left:10px;
        right:10px;
        -moz-border-radius:100px / 10px;
        border-radius:100px / 10px;
    }
    .mapWidget:after
    {
        right:10px;
        left:auto;
        -webkit-transform:skew(8deg) rotate(3deg);
        -moz-transform:skew(8deg) rotate(3deg);
        -ms-transform:skew(8deg) rotate(3deg);
        -o-transform:skew(8deg) rotate(3deg);
        transform:skew(8deg) rotate(3deg);
    }
    #popupMap {
        border-bottom:1px solid #ccc;height:250px;margin:-25px -25px 0 -25px;
    }
    @media only screen and (max-height: 420px) {
        #popupMap {
            border-bottom:1px solid #ccc;height:150px;margin:-25px -25px 0 -25px;
        }
    }
</style>
<script>
    var mapWidget, validAddress=false;

    function GMapsWidget (targetDiv) {
        if (document.readyState != 'interactive' && document.readyState != 'complete') {
            throwError('ReadyState '+document.readyState+'. Not ready for map. Waiting.');
            setTimeout(function () {mapWidget = new GMapsWidget(targetDiv);}, 100);
            return function() {};
        }
        if (!(typeof window.google === 'object' && window.google.maps)) {
            throwError('Google Maps API is not ready...');
            return function() {};
        }
        this.address = '';
        this.ready = true;
        this.initCoords = new google.maps.LatLng(44.970797, -93.3315185);
        this.geocoder = new google.maps.Geocoder();
        this.setAddress = function (new_address)
        {
            this.address = new_address;
            this.geocoder.geocode( { 'address': this.address}, function(results, status) {
                if (status == 'OK') {
                    validAddress = true;
                    mapWidget.map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: mapWidget.map,
                        animation: google.maps.Animation.BOUNCE,
                        position: results[0].geometry.location
                    });
                    google.maps.event.trigger(mapWidget.map, 'resize');
                    setTimeout(function () {
                        console.log('Trying to fix tiles');
                        google.maps.event.trigger(mapWidget.map, 'resize');
                        mapWidget.map.setZoom(mapWidget.map.getZoom()-3);
                        setTimeout(function () {
                            mapWidget.map.setZoom(mapWidget.map.getZoom()+3);
                        }, 2500);
                    }, 1500);
                } else {
                    validAddress = false;
                    document.getElementById(targetDiv).innerHTML = '<h1>Address Not Found!</h1>' +
                        'Please double check and make sure the address is correct.';
                    throwError('Geocode was not successful for the following reason: ' + status);
                }
            });
        };

        var styleOptions = {
            minZoom: 8,
            maxZoom: 18,
            zoom: 17,
            zoomControl: true,
            draggable: false,
            center: this.initCoords,
            fullscreenControl: false,
            mapTypeControlOptions: {
                mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain','styled_map'],
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            styles: [
                {
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }]
                },{
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },{
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#616161"
                    }]
                },{
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }]
                },{
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#bdbdbd"
                    }]
                },{
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#eeeeee"
                    }]
                },{
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },{
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#e5e5e5"
                    }]
                },{
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#9e9e9e"
                    }]
                },{
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#97c6e7"
                    }]
                },{
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },{
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#3d95d3"
                    }]
                },{
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#616161"
                    }]
                },{
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#9e9e9e"
                    }]
                },{
                    "featureType": "transit.line",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#e5e5e5"
                    }]
                },{
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#eeeeee"
                    }]
                },{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#eaf4fa"
                    }]
                },{
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#3d95d3"
                    }]
                }
            ]
        };
        this.map = new google.maps.Map(document.getElementById(targetDiv), styleOptions);
    }

    function throwError (errorMessage) {
        if (typeof window.console === 'object' && window.console.error) {
            console.error('Maps Widget: '+errorMessage);
        } else {
            throw 'Maps Widget: '+errorMessage;
        }
    }
</script>
