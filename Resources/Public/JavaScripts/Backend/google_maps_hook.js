if (typeof TxContacts === "undefined") TxContacts = {};

TxContacts.init = function() {
    TxContacts.origin = new google.maps.LatLng(latitude, longitude);

    var myOptions = {
        zoom: 8,
        center: TxContacts.origin,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    TxContacts.map = new google.maps.Map(document.getElementById(idPrefix+"-map"), myOptions);
    TxContacts.marker = new google.maps.Marker({
        map: TxContacts.map,
        position: TxContacts.origin,
        draggable: true
    });

    google.maps.event.addListener(TxContacts.marker, "dragend", function() {

        var lat = TxContacts.marker.getPosition().lat().toFixed(6);
        var lng = TxContacts.marker.getPosition().lng().toFixed(6);

        TxContacts.updateValue(latitudeField, addressId, lat);
        TxContacts.updateValue(longitudeField, addressId, lng);

    });

    TxContacts.geocoder = new google.maps.Geocoder();

};

TxContacts.refreshMap = function() {
    google.maps.event.trigger(TxContacts.map, "resize");
    // No need to do it again
    Ext.fly(TxContacts.tabPrefix + "-MENU").un("click", TxContacts.refreshMap);
};

TxContacts.codeAddress = function(addressId) {
    var address = document.getElementById(idPrefix + '-address').value;

    TxContacts.geocoder.geocode({"address": address}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            TxContacts.map.setCenter(results[0].geometry.location);
            TxContacts.marker.setPosition(results[0].geometry.location);

            TxContacts.updateValue(latitudeField, addressId, +(Math.round(TxContacts.marker.getPosition().lat() + "e+8") + "e-8"));
            TxContacts.updateValue(longitudeField, addressId, +(Math.round(TxContacts.marker.getPosition().lng() + "e+8") + "e-8"));

        } else {
            console.log("Geocode was not successful for the following reason: " + status);
        }
    });
};

TxContacts.updateValue = function(fieldName, addressId, value) {
    var action = $("#EditDocumentController").attr('action');

    var selectorFieldName = "data[" + tableName + "][" + addressId + "][" + fieldName + "]";

    $("input[data-formengine-input-name='" + selectorFieldName + "']").val(value);
    $("input[name='" + selectorFieldName + "']").val(value);
};

function initTxContacts() {
    TxContacts.init();
}
