(function() {
    "use strict";

    function registerController(typeRestService) {

        // Init the types
        this.types = [];

        // Load types
        typeRestService.getTypes()
            .then(function(types) {
                this.types = types;
            }.bind(this));
    }

    angular.module('Frontoffice').controller(
        "registerController",
        [
            'typeRestService',
            registerController
        ]
    );

})();