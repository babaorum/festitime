(function() {
    "use strict";

    function typeRestService($http, $q) {
        var basicUrl = "/types";

        var getTypes = function(limit) {
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
            getTypes: getTypes
        };
    }

    angular.module('Rest').service(
        "typeRestService",
        [
            '$http',
            '$q',
            typeRestService
        ]
    );
})();
