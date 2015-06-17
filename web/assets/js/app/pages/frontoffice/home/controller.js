(function() {
    "use strict";

    function searchBarController($scope, festivalRestService, artistRestService, typeRestService) {

        this.festivals          = [];
        this.artists            = [];
        this.types              = [];
        this.festivalSearch     = [];
        this.artistSearch       = [];
        this.countdownFestivals = [];
        this.randomPictures     = [];

        this.range = function(n) {
            return new Array(n);
        };

        this.getCountdownFromDate = function(date) {
            date = new Date(date);
            return (date - 0);
        };

        /*$scope.$watch('search', function(newValue, oldValue) {
            if (newValue && newValue.length > 0) {
                console.log(newValue);
                var festivalSearch = [];
                var artistSearch   = [];
                this.festivals.forEach(function(festival) {
                    if (festivalSearch.length < 5 && festival.name.indexOf(newValue) > -1) {
                        festivalSearch.push(festival);
                    }
                });
                this.artists.forEach(function(artist) {
                    if (artistSearch.length < 2) {
                        if (artist.pseudo && artist.pseudo.indexOf(newValue) > -1) {
                            artistSearch.push(artist);
                        } else if (!artist.pseudo
                            && (artist.firstname.indexOf(newValue) > -1
                                || artist.lastname.indexOf(newValue) > -1)
                            ) {
                            artistSearch.push(artist);
                        }
                    }
                });
                console.log(festivalSearch);
                console.log(artistSearch);
                this.festivalSearch = festivalSearch;
                this.artistSearch   = artistSearch;
            } else {
                this.festivalSearch     = [];
                this.artistSearch       = [];
            }
        }.bind(this));*/

        //load festivals
        festivalRestService.getFestivals(9)
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
