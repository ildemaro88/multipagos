var app = angular.module('MyApp', [], function ($interpolateProvider)
{
 $interpolateProvider.startSymbol('[[');
 $interpolateProvider.endSymbol(']]');
});

//Declaracion de la url base del proyecto.
// URL_BASE se declara en el archivo public/js/configServer.js

app.constant('API_URL', URL_BASE);


//agenda.constant('API_URL','htpp://localhost/MedicSystem/public/admin');
