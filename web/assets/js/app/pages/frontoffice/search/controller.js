(function() {
    "use strict";

    function searchPageController($scope, typeRestService) {

        this.types              = [];

        this.includeType = function(type) {
            $scope.$broadcast('searchFestivalsIncludeType', type);
        }.bind(this);

        // Load types
        typeRestService.getTypes()
            .then(function(types) {
                this.types = types;
            }.bind(this));
    }

    angular.module('Frontoffice').controller(
        "searchPageController",
        [
            '$scope',
            'typeRestService',
            searchPageController
        ]
    );

})();
