function initMap() {
    var uluru = {
    lat: 31.669746,
    lng: -7.973328
    };
    var map = new google.maps.Map(document.getElementById('map'), {
    center: uluru,
    zoom: 10,
    scrollwheel: false
    });
    var marker = new google.maps.Marker({position: uluru, map: map});
    marker.setTitle("Marrakech");
    }