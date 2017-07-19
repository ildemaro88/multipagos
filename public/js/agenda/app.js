var agenda = angular.module("AppAgenda", [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

//agenda.constant('API_URL','htpp://localhost/MedicSystem/public/admin');