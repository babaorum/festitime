(function() {
    "use strict";

    function rome2rioRestService(FESTITIME_CONSTS, $http, $q) {
        var baseUrl = 'http://free.rome2rio.com/api/1.2/json/Search';

        var getTravels = function(departurePlace, arrivalPlace) {
           var url = baseUrl+'?languageCode=fr&key='+FESTITIME_CONSTS.ROME2RIO_TOKEN+'&oName='+departurePlace+'&dName='+arrivalPlace;

            return $http({
                "method": "get",
                "url": url
            }).then(handleSuccess, handleError);
        };

        var handleError = function(response) {
            if (
                !angular.isObject( response.data ) ||
                !response.data.message
            ) {
                return ($q.reject("An unknown error occurred."));
            }
            // Otherwise, use expected error message.
            return ($q.reject(response.data.message));
        };

        var handleSuccess = function(response) {
            return response.data;
        };

        return {
            getTravels: getTravels
        };
    }

    angular.module('Rest').service(
        "rome2rioRestService",
        [
            'FESTITIME_CONSTS',
            '$http',
            '$q',
            rome2rioRestService
        ]
    );
})();
