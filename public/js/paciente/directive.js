cita.directive('listaMedico', function ($timeout) {
    return {
        restrict: 'E',
        replace: 'true',
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    scope.$emit(attr.onFinishRender);
                });
            }
        },
        template: '<div class="col-md-3" ng-repeat="m in medico | filter:busqueda" ng-click="selected(m.id,m.titulo,m.nombre,m.apellido)">' +
        '<div class="panel itemMedic">' +
        '<i ng-show="check[m.id]" class="fa fa-check-circle checked"></i>' +
        '<div class="panel-body" align="center">' +
        '<img class="img-thumbnail" style="width:70%;" src="'+PATH_IMG+'" alt="">' +
        '<h5><b>[[m.titulo+" "+m.nombre+" "+m.apellido]]</b></h5>' +
        '<em>[[m.especialidad]]</em>' +
        '</div>' +
        '</div>' +
        '</div>'
    };
});
/*
*  citasDisponibles:  Carga las citas disponibles basado en ng-repeat con json devuelto
* */
cita.directive('citasDisponibles', function () {
    return {
        restrict: 'E',
        replace: true,
        link: function (scope, element) {
            if (scope.$last === true) {
                element.ready(function () {
                });
            }
        },
        template: '<div ng-show="!loading" style="max-height: 400px;overflow-y: auto;" class="list-group">' +
        '<div class="list-group-item"><b style="color: #5e7694">HORARIO</b> <b class="pull-right" style="color: #5e7694">ESTADO</b> </div>' +
        '<a ng-click="selectHorario(res.start,res.end,res.estado)" href="javascript:void(0)" ng-repeat="res in cDisponible" class="list-group-item">[[ res.start ]] - [[res.end]] <button class="btn [[ res.estado == \'Disponible\' ? \'btn-success\':\'btn-danger\' ]] btn-xs pull-right">[[res.estado]]</button></a>' +
        '<div id="msg"></div>'+
        '</div>'
    }
});
cita.directive('loadIng',function(){
    return {
        restrict: 'E',
        replace: false,
        link: function (scope, element) {
            if (scope.$last === true) {
                element.ready(function () {
                });
            }
        },
        template: '<div ng-show="loading"><i class="fa fa-refresh fa-spin fa-3x fa-fw col-sm-offset-4"></i><span class="alert bg-warning"><b> Espere...</b></span></div>'
    }
});
