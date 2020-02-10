var mapInitObj = {};

// function called directly by google maps integration asynchronously
function getMapData() {
    if ($('body').find('.map:not(.inited)').length > 0) {
        $('body').find('.map:not(.inited)')
            .each(function () {
                var map = $(this).addClass('inited');

                // get global options
                var mapId = map.attr('id');
                var mapZoom = map.data('zoom');
                var mapHue = map.data('hue');
                var mapSaturation = map.data('saturation');
                var mapLightness = map.data('lightness');
                var mapMarkers = [];
                var stylers = [{
                    "stylers": [{
                        "hue": mapHue
                    }, {
                        "saturation": mapSaturation
                    }, {
                        "lightness": mapLightness
                    }]
                }];

                // get marker options
                map.find('.map-marker').each(function () {
                    var marker = $(this);

                    mapMarkers.push({
                        title: marker.data('title'),
                        description: marker.html(),
                        address: marker.data('address'),
                        lat: round(parseFloat(marker.data('lat')), 6),
                        lng: round(parseFloat(marker.data('lon')), 6),
                        point: marker.data('point')
                    });
                });

                initMap($('#' + mapId).get(0), {
                    zoom: mapZoom,
                    markers: mapMarkers,
                    styles: stylers
                });
            });
    }
}

function initMap(domObject, options) {
    try {
        var id = domObject.id;

        mapInitObj[id] = {
            dom: domObject,
            markers: options.markers,
            opt: {
                zoom: options.zoom,
                center: null,
                scrollwheel: false,
                scaleControl: false,
                disableDefaultUI: false,
                panControl: true,
                zoomControl: true,
                mapTypeControl: false,
                streetViewControl: false,
                overviewMapControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: options.styles
            }
        };

        createMap(id);
    } catch (e) {
        console.log('Something went wrong :(');
    }
}

function createMap(id) {
    // create map
    mapInitObj[id].map = new google.maps.Map(mapInitObj[id].dom, mapInitObj[id].opt);

    // add markers
    addMarkers(id);

    // resize listener
    $(window).resize(function () {
        if (mapInitObj[id].map) {
            mapInitObj[id].map.setCenter(mapInitObj[id].opt.center);
        }
    });
}

function addMarkers(id) {
    for (var i in mapInitObj[id].markers) {

        var markerInit = {
            map: mapInitObj[id].map,
            position: {lat: mapInitObj[id].markers[i].lat, lng: mapInitObj[id].markers[i].lng},
            clickable: mapInitObj[id].markers[i].description != ''
        };

        if (mapInitObj[id].markers[i].point) {
            markerInit.icon = mapInitObj[id].markers[i].point;
        }

        if (mapInitObj[id].markers[i].title) {
            markerInit.title = mapInitObj[id].markers[i].title;
        }

        mapInitObj[id].markers[i].marker = new google.maps.Marker(markerInit);

        // set map center
        if (mapInitObj[id].opt.center == null) {
            mapInitObj[id].opt.center = markerInit.position;
            mapInitObj[id].map.setCenter(mapInitObj[id].opt.center);
        }

        // add description window
        if (mapInitObj[id].markers[i].description !== '') {

            mapInitObj[id].markers[i].infowindow = new google.maps.InfoWindow({
                content: mapInitObj[id].markers[i].description
            });

            google.maps.event.addListener(mapInitObj[id].markers[i].marker, 'click', function (e) {
                var latLng = e.latLng;
                var lat = round(latLng.lat(), 6),
                    lng = round(latLng.lng(), 6);

                for (var i in mapInitObj[id].markers) {
                    if (lat === mapInitObj[id].markers[i].lat && lng === mapInitObj[id].markers[i].lng) {
                        mapInitObj[id].markers[i].infowindow.open(
                            mapInitObj[id].map,
                            mapInitObj[id].markers[i].marker
                        );
                        break;
                    }
                }
            });
        }
    }
}

// helper function for perfect rounding
function round(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}
