(function () {
    "use strict";

    var test = 'test';

    angular.module(
        "Frontoffice",
        [
            "Rest",
            "Filter",
            //To uncomment when angular-bootstrap work with angular 1.3.*
            //"ui.bootstrap",
            "timer"
        ]
    ).config(function($interpolateProvider){
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

})();
