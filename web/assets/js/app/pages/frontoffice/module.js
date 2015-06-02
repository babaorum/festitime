(function () {
    "use strict";

    angular.module(
        "Frontoffice",
        [
            "Rest",
            "Filter",
            //To uncomment when angular-bootstrap work with angular 1.3.*
            //"ui.bootstrap",
            "ngAnimate",
            "timer"
        ]
    )
    .config(function($interpolateProvider){
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    })
    .constant( 'FESTITIME_CONSTS', {
        'ROME2RIO_TOKEN': 'If5B9HTd'
    });

})();
