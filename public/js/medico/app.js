var agenda = angular.module("AppAgenda", ['rzModule'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

//agenda.constant('API_URL','htpp://localhost/MedicSystem/public/admin');