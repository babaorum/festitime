(function() {
    "use strict";

    function festivalController($scope, rome2rioRestService, festivalRestService, typeRestService) {
        this.festival = {};

        // DisplayedArtists
        this.artists  = [];

        // Init the package selection scope variable
        this.package;

        // Contain Rome2rio travels information
        this.travels;

        // Init the hotels
        this.hotels = [];

        // Init the types
        this.types = [];

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
                    getTickets();
                    getHotels();
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
            } else {
                this.artists = this.festival.artists;
            }
        }.bind(this);

        var getTickets = function() {
            this.festival.tickets = [
                {
                    name: "ticket1",
                    description: "description tral la aala lorem ipsum idolorium expeliormus tatam lagli",
                    price: 15
                },
                {
                    name: "ticket 2",
                    description: "description tral la aala lorem ipsum idolorium expeliormus tatam lagli",
                    price: 150
                }
            ];
        }.bind(this);

        var getHotels = function() {
            this.hotels = [
                {
                    name: "hotel lolilol kikou1",
                    description: "mini description (style hotel 3 étoiles trop top)",
                    price: 25
                },
                {
                    name: "hotel lolilol kikou 2",
                    description: "mini description (style hotel 3 étoiles trop top)",
                    price: 25
                },
                {
                    name: "hotel lolilol kikou 3",
                    description: "mini description (style hotel 3 étoiles trop top)",
                    price: 25
                },
                {
                    name: "hotel lolilol kikou 4",
                    description: "mini description (style hotel 3 étoiles trop top)",
                    price: 25
                },
                {
                    name: "hotel lolilol kikou 5",
                    description: "mini description (style hotel 3 étoiles trop top)",
                    price: 25
                },
                {
                    name: "hotel lolilol kikou 6",
                    description: "mini description (style hotel 3 étoiles trop top)",
                    price: 25
                }
            ];
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
