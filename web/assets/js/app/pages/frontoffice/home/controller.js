(function () {
    "use strict";

    function searchBarController($scope, festivalRestService) {

        this.festivals = [];
        this.types = [];

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


        //load festivals
        festivalRestService.getFestivals()
            .then(function(festivals) {
                this.festivals = festivals;
            }.bind(this));
    }

    angular.module('Frontoffice').controller(
        "searchBarController",
        ['$scope', 'festivalRestService', searchBarController]
    );

})();
