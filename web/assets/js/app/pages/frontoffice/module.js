(function () {
    "use strict";

    angular.module(
        "Frontoffice",
        [
            "Rest",
            "Filter",
            "timer"
        ]
    ).config(function($interpolateProvider){
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

})();
