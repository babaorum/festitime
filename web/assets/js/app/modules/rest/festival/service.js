(function() {
    "use strict";

    function festivalRestService($http, $q) {
        var basicUrl = "/festivals";

        var getFestivals = function(limit) {
            var url = basicUrl;

            if (limit) {
                url += '?limit='+limit;
            }

            return $http({
                "method": "get",
                "url": url
            }).then(handleSuccess, handleError);
        };

        var getFestivalsRandomPictures = function(number) {
            return $http({
                method: 'get',
                url: '/festivals/' + number + '/random/pictures'
            }).then(handleSuccess, handleError);
        }

        var removeFestival = function(id) {
            return $http({
                method: "delete",
                url: "api/index.cfm",
                params: {
                    action: "delete"
                },
                data: {
                    id: id
                }
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
            getFestivals:               getFestivals,
            getFestivalsRandomPictures: getFestivalsRandomPictures,
            removeFestival:             removeFestival
        };
    }

    festivalRestService.prototype = {
    };

    angular.module('Rest').service(
        "festivalRestService",
        [
            '$http',
            '$q',
            festivalRestService
        ]
    );
})();
