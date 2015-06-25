(function() {
    "use strict";

    function festivalController($scope, rome2rioRestService, festivalRestService, typeRestService) {
        this.festival = {};

        // DisplayedArtists
        this.artists  = [];

        this.otherArtists = [];

        // Init the package selection scope variable
        this.package = {
            state: 'create'
        };

        // Contain Rome2rio travels information
        this.travels;

        // Init the types
        this.types = [];

        this.getFestival = function(id) {
            festivalRestService.getFestival(id)
                .then(function(festival) {
                    this.festival = festival;
                    getDisplayedArtists();
                    getTravels();
                }.bind(this));
        }.bind(this);

        // Load types
        typeRestService.getTypes()
            .then(function(types) {
                this.types = types;
            }.bind(this));

        var getDisplayedArtists = function() {
            if (this.festival.artists.length > 4) {
                this.artists = this.festival.artists.slice(0, 4);
                this.otherArtists = this.festival.artists.slice(4, this.festival.artists.length);
            } else {
                this.artists = this.festival.artists;
            }
        }.bind(this);

        var getTravels = function() {
            rome2rioRestService.getTravels('Paris', this.festival.city)
                .then(function(travels) {
                    this.travels = travels;
                    console.log(travels);
                }.bind(this));
        }.bind(this);
    }

    angular.module('Frontoffice').controller(
        "festivalController",
        [
            '$scope',
            'rome2rioRestService',
            'festivalRestService',
            'typeRestService',
            festivalController
        ]
    );

})();
