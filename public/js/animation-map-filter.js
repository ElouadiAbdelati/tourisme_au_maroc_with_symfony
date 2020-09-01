function initMap() {
    var uluru = {
    lat: lat,
    lng: lng
    };
    
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: uluru,
    scrollwheel: true, /*mapTypeId: 'satellite'*/
    mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker = new google.maps.Marker({
    position: uluru, map: map, clickable: true, animation: google.maps.Animation.BOUNCE /*DROP*/
    });
    marker.setTitle("cmnt");
    marker.addListener('click', function () {
    $('html,body').animate({
    scrollTop: $("#" + marker.getTitle()).offset().top
    }, 'slow');
    });
    var markers = [];
    for (let i = 0; i < hotelMarkers.length; i++) {
    var mh = new google.maps.Marker({
    position: hotelMarkers[i].position, map: map,
    icon: {
    url: '../img/marker_icon/hotel_50.png'
    }
    });
    mh.setTitle(hotelMarkers[i].title);
    markers.push(mh);
    }
    for (let i = 0; i < restoMarkers.length; i++) {
    var mr = new google.maps.Marker({
    position: restoMarkers[i].position, map: map,
    icon: '../img/marker_icon/resto_50.png'
    });
    mr.setTitle(restoMarkers[i].title);
    markers.push(mr);
    }
    for (let i = 0; i < campingMarkers.length; i++) {
    var mc = new google.maps.Marker({position: campingMarkers[i].position, map: map, icon: '../img/marker_icon/tent50.png'});
    mc.setTitle(campingMarkers[i].title);
    markers.push(mc);
    }
    for (let i = 0; i < activiteMarkers.length; i++) {
    var ma = new google.maps.Marker({position: activiteMarkers[i].position, map: map, icon: '../img/marker_icon/activite50.png'});
    ma.setTitle(activiteMarkers[i].title);
    markers.push(ma);
    }
var infowindow = new google.maps.InfoWindow();
markers.map((m) => {
m.addListener('click', function () {
$('html,body').animate({
scrollTop: $("#" + m.getTitle()).offset().top
}, 'slow');
$("#" + m.getTitle()).hide(1100);
$("#" + m.getTitle()).show(2000);
// $("#" + m.getTitle()).animate({height: '+=20%'});
});
m.addListener('mouseover', function () {
infowindow.setContent(m.getTitle());
infowindow.open(map, m);
});
});
$("#customControlValidation1").change(function () {
if (this.checked) {
markers.map((m) => {
for (let i = 0; i < hotelMarkers.length; i++) {
if (m.getTitle() == hotelMarkers[i].title) {
m.setVisible(true);
}
}
});
} else {
markers.map((m) => {
for (let i = 0; i < hotelMarkers.length; i++) {
if (m.getTitle() == hotelMarkers[i].title) {
m.setVisible(false);
}
}
});
}
});
$("#customControlValidation3").change(function () {
if (this.checked) {
markers.map((m) => {
for (let i = 0; i < activiteMarkers.length; i++) {
if (m.getTitle() == activiteMarkers[i].title) {
m.setVisible(true);
}
}
});
} else {
markers.map((m) => {
for (let i = 0; i < activiteMarkers.length; i++) {
if (m.getTitle() == activiteMarkers[i].title) {
m.setVisible(false);
}
}
});
}
});
$("#customControlValidation2").change(function () {
if (this.checked) {
markers.map((m) => {
for (let i = 0; i < restoMarkers.length; i++) {
if (m.getTitle() == restoMarkers[i].title) {
m.setVisible(true);
}
}
});
} else {
markers.map((m) => {
for (let i = 0; i < restoMarkers.length; i++) {
if (m.getTitle() == restoMarkers[i].title) {
m.setVisible(false);
}
}
});
}
});
$("#customControlValidation4").change(function () {
if (this.checked) {
markers.map((m) => {
for (let i = 0; i < campingMarkers.length; i++) {
if (m.getTitle() == campingMarkers[i].title) {
m.setVisible(true);
}
}
});
} else {
markers.map((m) => {
for (let i = 0; i < campingMarkers.length; i++) {
if (m.getTitle() == campingMarkers[i].title) {
m.setVisible(false);
}
}
});
}
});
}