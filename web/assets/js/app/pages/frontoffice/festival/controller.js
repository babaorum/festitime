(function() {
    "use strict";

    function festivalController($scope, rome2rioRestService, festivalRestService) {
        this.festival = {};
        this.travels
        //load travels

        var getTravels = function() {
            rome2rioRestService.getTravels('Paris', this.festival.city)
                .then(function(travels) {
                    this.travels = travels;
                    console.log(travels);
                }.bind(this));
        }.bind(this);

        this.getFestival = function(id) {
            festivalRestService.getFestival(id)
                .then(function(festival) {
                    this.festival = festival;
                    $scope.festivalPicture = {
                        background: 'url('+ festival.img +')'
                    };
                    getTravels();
                }.bind(this));
        }.bind(this);
    }

    angular.module('Frontoffice').controller(
        "festivalController",
        [
            '$scope',
            'rome2rioRestService',
            'festivalRestService',
            festivalController
        ]
    );

})();
