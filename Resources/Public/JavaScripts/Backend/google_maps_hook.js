if (typeof TxContacts === "undefined") TxContacts = {};

TxContacts.init = function() {

    TxContacts.origin = new google.maps.LatLng(latitude, longitude);

    var myOptions = {
        zoom: 8,
        center: TxContacts.origin,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    TxContacts.map = new google.maps.Map(document.getElementById(mapId), myOptions);
    TxContacts.marker = new google.maps.Marker({
        map: TxContacts.map,
        position: TxContacts.origin,
        draggable: true
    });

    google.maps.event.addListener(TxContacts.marker, "dragend", function() {

        var lat = TxContacts.marker.getPosition().lat().toFixed(6);
        var lng = TxContacts.marker.getPosition().lng().toFixed(6);

        TxContacts.updateValue(latitudeField, lat);
        TxContacts.updateValue(longitudeField, lng);

    });

    TxContacts.geocoder = new google.maps.Geocoder();

};

TxContacts.refreshMap = function() {
    google.maps.event.trigger(TxContacts.map, "resize");
    // No need to do it again
    Ext.fly(TxContacts.tabPrefix + "-MENU").un("click", TxContacts.refreshMap);
};

TxContacts.codeAddress = function() {
    var address = document.getElementById("inputAddress").value;
    TxContacts.geocoder.geocode({"address": address}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            TxContacts.map.setCenter(results[0].geometry.location);
            TxContacts.marker.setPosition(results[0].geometry.location);

            TxContacts.updateValue(latitudeField, math.round(TxContacts.marker.getPosition().lat()));
            TxContacts.updateValue(longitudeField, math.round(TxContacts.marker.getPosition().lng()));

        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
};

TxContacts.updateValue = function(fieldName, value) {
    if (version < 8007000) {
        document[TBE_EDITOR.formname][fieldName].value = value;
        TYPO3.jQuery("[data-formengine-input-name='" + fieldName + "']").val(value);
    } else {
        var selectorFieldName = "data[" + tableName + "][1][" + fieldName + "]";
        TYPO3.jQuery("input[data-formengine-input-name='" + selectorFieldName + "']").val(value);
        TYPO3.jQuery("input[name='" + selectorFieldName + "']").val(value);
    }
};

window.onload = TxContacts.init;
