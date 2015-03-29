(function() {
    "use strict";

    function searchFestivals() {

        function Controller($scope, festivalRestService) {
            this.festivals = [];
            this.types = [];

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

            this.includeType = function(type) {
                var i = this.types.indexOf(type);
                if (i > -1) {
                    this.types.splice(i, 1);
                } else {
                    this.types.push(type);
                }
            }.bind(this);

            $scope.$on('searchFestivalsIncludeType', function(event, type) {
                this.includeType(type);
            }.bind(this));

            $scope.$watch('types', function(type) {
                if (type) {
                    this.types.push(type);
                }
            }.bind(this));

            //load festivals
            festivalRestService.getFestivals()
                .then(function(festivals) {
                    this.festivals = festivals;
                }.bind(this));
        }

        return {
            restrict: "E",
            scope: {
                types: '=',
                festivals: '=',
                searchText: '='
            },
            controller: ["$scope", 'festivalRestService', Controller],
            controllerAs: 'searchFestivalsCtrl',
            templateUrl: '/assets/js/app/pages/frontoffice/search/template.html'
        }
    }

    angular.module('Frontoffice').directive(
        "searchFestivals",
        searchFestivals
    );

})();