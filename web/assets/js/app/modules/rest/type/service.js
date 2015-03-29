(function(){
    "use strict";

    function typeRestService($http, $q) {

        var getTypes = function() {
            return [
                "electro",
                "rock",
                "pop",
                "hip-hop",
                "rap",
                "reggae",
                "ragga",
                "jazz",
                "dark",
                "metal",
                "punk"
            ];
        };

        return {
            getTypes: getTypes
        };
    }

    angular.module('Rest').service(
        "typeRestService",
        ['$http', '$q', typeRestService]
    );
})();
