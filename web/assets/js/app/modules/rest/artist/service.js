(function() {
    "use strict";

    function artistRestService($http, $q) {
        var basicUrl = "/artists";

        var getArtists = function(limit) {
            var url = basicUrl;

            if (limit) {
                url += '?limit='+limit;
            }

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
            getArtists: getArtists
        };
    }

    angular.module('Rest').service(
        "artistRestService",
        [
            '$http',
            '$q',
            artistRestService
        ]
    );
})();
