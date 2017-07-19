var cita = angular.module("AppPaciente", ["ngAnimate"], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});
