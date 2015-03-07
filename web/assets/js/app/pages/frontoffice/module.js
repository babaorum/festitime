(function () {
	"use strict";

	angular.module(
		"Frontoffice",
		["Rest"] 
	).config(function($interpolateProvider){
	        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
	});

})();
