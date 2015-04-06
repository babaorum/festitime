(function() {
    "use strict";

    function searchBarController($scope, festivalRestService, artistRestService, typeRestService) {

        this.festivals          = [];
        this.artists            = [];
        this.types              = [];
        this.countdownFestivals = [];
        this.randomPictures     = [];

        this.range = function(n) {
            return new Array(n);
        };

        this.getCountdownFromDate = function(date) {
            date = new Date(date);
            return (date - 0);
        };

        //load festivals
        festivalRestService.getFestivals(6)
            .then(function(festivals) {
                festivals.forEach(function(festival) {
                    if (festival.start_date && this.countdownFestivals.length < 1) {
                        festival.countdown = this.getCountdownFromDate(festival.start_date);
                        this.countdownFestivals.push(festival);
                    }
                    this.festivals.push(festival);
                }.bind(this));
            }.bind(this));

        //Load artists
        artistRestService.getArtists(3)
            .then(function(artists) {
                console.log(artists);
                this.artists = artists;
            }.bind(this));

        //Load types
        this.types = typeRestService.getTypes();

        //Load randomPictures
        festivalRestService.getFestivalsRandomPictures(16)
            .then(function(pictures) {
                this.randomPictures = pictures;
            }.bind(this));
    }

    angular.module('Frontoffice').controller(
        "searchBarController",
        [
            '$scope',
            'festivalRestService',
            'artistRestService',
            'typeRestService',
            searchBarController
        ]
    );

})();
