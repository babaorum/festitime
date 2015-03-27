(function () {
    "use strict";

    function searchBarController($scope, festivalRestService) {

        this.festivals          = [];
        this.types              = [];
        this.countdownFestivals = [];
        this.randomPictures     = [];

        this.range = function(n) {
            return new Array(n);
        };

        this.includeType = function(type) {
            var i = this.types.indexOf(type);
            if (i > -1) {
                this.types.splice(i, 1);
            } else {
                this.types.push(type);
            }
        }.bind(this);

        this.typeFilter = function(festival) {
            if(this.types.length > 0) {
                var match = false;
                for (var i in festival.type) {
                    if(this.types.indexOf(festival.type[i]) > -1)
                    {
                        match = true;
                    }
                }
                if(!match)
                    return;
            }

            return festival;
        }.bind(this);

        this.getCountdownFromDate = function(date) {
            var now  = new Date();
            var date = new Date(date);
            return (date-0);
        };

        //load festivals
        festivalRestService.getFestivals()
            .then(function(festivals) {
                festivals.forEach(function(festival) {
                    if(festival.start_date && this.countdownFestivals.length < 1) {
                        festival.countdown = this.getCountdownFromDate(festival.start_date);
                        this.countdownFestivals.push(festival);
                    }
                    this.festivals.push(festival);
                }.bind(this));
            }.bind(this));

        festivalRestService.getFestivalsRandomPictures(16)
            .then(function(pictures) {
                this.randomPictures = pictures;
            }.bind(this));
    }

    angular.module('Frontoffice').controller(
        "searchBarController",
        ['$scope', 'festivalRestService', searchBarController]
    );

})();
