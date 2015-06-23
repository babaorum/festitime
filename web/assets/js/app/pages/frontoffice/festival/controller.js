(function() {
    "use strict";

    function festivalController($scope, rome2rioRestService, festivalRestService) {
        this.festival = {};

        // DisplayedArtists
        this.artists  = [];

        // Contain Rome2rio travels information
        this.travels;

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
                    getDisplayedArtists();
                    getTravels();
                }.bind(this));
        }.bind(this);

        var getDisplayedArtists = function() {
            if (this.festival.artists.length > 4) {
                this.artists = this.festival.artists.slice(0, 4);
                console.log(this.artists);
            } else {
                this.artists = this.festival.artists;
            }
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
