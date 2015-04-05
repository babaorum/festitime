(function () {
    "use strict";

    angular.module(
        "Frontoffice",
        [
            "Rest",
            "Filter",
            "ui.bootstrap",
            "timer"
        ]
    ).config(function($interpolateProvider){
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

})();
