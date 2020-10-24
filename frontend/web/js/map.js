'use strict';

let map = document.querySelector('#map');
let coordlat = map.getAttribute('data-lat');
let coordLong = map.getAttribute('data-long');
let myMap;

function getLocation() {
    myMap = new window.ymaps.Map("map", {
        center: [coordLong, coordlat],
        zoom: 15
    });

    let place = new window.ymaps.Placemark(
        [coordLong, coordlat], {}, {
            preset: "twirl#redIcon"
        }
    );
    myMap.geoObjects.add(place);
}


function init() {
    if (navigator.geolocation) {
        getLocation();
    } else {
        document.getElementById("map").innerHTML = "Geolocation API не поддерживается в вашем браузере";
    }
}

window.ymaps.ready(init);
