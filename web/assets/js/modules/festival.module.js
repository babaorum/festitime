// Define the module for our AngularJS application.
        var app = angular.module( "festival", [] ).config(function($interpolateProvider){
                $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
            }
        );
        // I control the main demo.
        app.controller("searchBarController", ['$scope', 'festivalService', function( $scope, festivalService ) {
 
                // I contain the list of festivals to be rendered.
                $scope.festivals = [];
                $scope.types = [];                
                
                function includeType(type){
                    var i = $scope.types.indexOf(type);
                    if (i > -1) {
                        $scope.types.splice(i, 1);
                    } else {
                        $scope.types.push(type);
                    }
                };
                $scope.includeType = includeType; 

                $scope.typeFilter = function(festival){
                    if($scope.types.length > 0) {
                        var match = false;
                        for (var i in festival.type) {
                            if($scope.types.indexOf(festival.type[i]) > -1)
                            {
                                match = true;
                            }
                        }
                        if(!match)
                            return;
                    }

                    return festival;
                }
 
                loadRemoteData();
 
                // I apply the remote data to the local scope.
                function applyRemoteData( newFestivals ) {
 
                    $scope.festivals = newFestivals;
 
                }
 
 
                // I load the remote data from the server.
                function loadRemoteData() {
 
                    // The festivalService returns a promise.
                    festivalService.getFestivals()
                        .then(
                            function( festivals ) {
 
                                applyRemoteData( festivals );
 
                            }
                        )
                    ;
 
                }

 
            }]
        );
 
 
        // -------------------------------------------------- //
        // -------------------------------------------------- //
 
 
        // I act a repository for the remote festival collection.
        app.service(
            "festivalService",
            function( $http, $q ) {
 
                // Return public API.
                return({
                    addFestival: addFestival,
                    getFestivals: getFestivals,
                    removeFestival: removeFestival
                });
 
 
                // ---
                // PUBLIC METHODS.
                // ---
 
 
                // I add a festival with the given name to the remote collection.
                function addFestival( name ) {
 
                    var request = $http({
                        method: "post",
                        url: "api/index.cfm",
                        params: {
                            action: "add"
                        },
                        data: {
                            name: name
                        }
                    });
 
                    return( request.then( handleSuccess, handleError ) );
 
                }
 
 
                // I get all of the festivals in the remote collection.
                function getFestivals() {
 
                    var request = $http({
                        method: "get",
                        url: "/festivals"
                    });
 
                    return( request.then( handleSuccess, handleError ) );
 
                }
 
 
                // I remove the festival with the given ID from the remote collection.
                function removeFestival( id ) {
 
                    var request = $http({
                        method: "delete",
                        url: "api/index.cfm",
                        params: {
                            action: "delete"
                        },
                        data: {
                            id: id
                        }
                    });
 
                    return( request.then( handleSuccess, handleError ) );
 
                }
 
 
                // ---
                // PRIVATE METHODS.
                // ---
 
 
                // I transform the error response, unwrapping the application dta from
                // the API response payload.
                function handleError( response ) {
 
                    // The API response from the server should be returned in a
                    // nomralized format. However, if the request was not handled by the
                    // server (or what not handles properly - ex. server error), then we
                    // may have to normalize it on our end, as best we can.
                    if (
                        ! angular.isObject( response.data ) ||
                        ! response.data.message
                        ) {
 
                        return( $q.reject( "An unknown error occurred." ) );
 
                    }
 
                    // Otherwise, use expected error message.
                    return( $q.reject( response.data.message ) );
 
                }
 
 
                // I transform the successful response, unwrapping the application data
                // from the API response payload.
                function handleSuccess( response ) {
 
                    return( response.data );
 
                }
 
            }
        );