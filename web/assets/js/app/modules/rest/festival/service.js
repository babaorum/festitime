(function() {
    "use strict";

    function festivalRestService($http, $q) {

        var addFestival = function(name) {
            return $http({
                method: "post",
                url: "api/index.cfm",
                params: {
                    action: "add"
                },
                data: {
                    name: name
                }
            }).then(handleSuccess, handleError);
        };

        var getFestivals = function() {
            return $http({
                method: "get",
                url: "/festivals"
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
            addFestival:                addFestival,
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
