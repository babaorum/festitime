(function () {
    "use strict";

    angular.module(
        "Frontoffice",
        [
            "Rest",
            "timer"
        ]
    ).config(function($interpolateProvider){
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

})();
