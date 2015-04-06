(function() {
    "use strict";

    function searchPageController($scope, typeRestService) {

        this.types              = [];

        this.includeType = function(type) {
            $scope.$broadcast('searchFestivalsIncludeType', type);
        }.bind(this);

        this.types = typeRestService.getTypes();
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
