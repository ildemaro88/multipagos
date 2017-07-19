agenda.directive('horaInicio', function () {
    return {
        restrict: 'E',
        require: 'ngModel',
        replace: true,
        link: function (scope, element, attrs) {
            /*scope.timings = ['7:00 am', '7:15 am', '7:30 am', '7:45 am', '8:00 am', '8:15 am',
             '8:30 am', '8:45 am', '9:00 am', '9:15 am', '9:30 am', '9:45 am',
             '10:00 am', '10:15 am', '10:30 am', '10:45 am', '11:00 am', '11:15 am', '11:30 am', '11:45 am',
             '12:00 pm', '12:15 pm', '12:30 pm', '12:45 pm', '13:00 pm', '13:15 pm',
             '13:30 pm', '13:45 pm', '14:00 pm', '14:15 pm', '14:30 pm', '14:45 pm',
             '15:00 pm', '15:15 pm', '15:30 pm', '15:45 pm', '16:00 pm', '16:15 pm',
             '16:30 pm', '16:45 pm', '17:00 pm', '17:15 pm', '17:30 pm', '17:45 pm',
             '18:00 pm', '18:15 pm', '18:30 pm', '18:45 pm', '19:00 pm', '19:15 pm',
             '19:30 pm', '19:45 pm', '20:00 pm', '20:15 pm', '20:30 pm', '20:45 pm',
             '21:00 pm', '21:15 pm', '21:30 pm', '21:45 pm', '22:00 pm', '22:15 pm',
             '22:30 pm', '22:45 pm', '23:00 pm', '23:15 pm', '23:30 pm', '23:45pm',
             '00:00 am', '00:15 am', '00:30 am', '00:45 am', '1:00 am', '1:15 am',
             '1:30 am', '1:45 am', '2:00 am', '2:15 am', '2:30 am', '2:45 am',
             '3:00 am', '3:15 am', '3:30 am', '3:45 am', '4:00 am', '4:15 am',
             '4:30 am', '4:45 am', '5:00 am', '5:15 am', '5:30 am', '5:45 am',
             '6:00 am', '6:15 am', '6:30 am', '6:45 am'
             ];*/
            scope.timings = ['7:00 am', '7:15 am', '7:30 am', '7:45 am', '8:00 am', '8:15 am',
                '8:30 am', '8:45 am', '9:00 am', '9:15 am', '9:30 am', '9:45 am',
                '10:00 am', '10:15 am', '10:30 am', '10:45 am', '11:00 am', '11:15 am', '11:30 am', '11:45 am',
                '12:00 pm', '12:15 pm', '12:30 pm', '12:45 pm', '13:00 pm', '13:15 pm',
                '13:30 pm', '13:45 pm', '14:00 pm', '14:15 pm', '14:30 pm', '14:45 pm',
                '15:00 pm', '15:15 pm', '15:30 pm', '15:45 pm', '16:00 pm', '16:15 pm',
                '16:30 pm', '16:45 pm', '17:00 pm', '17:15 pm', '17:30 pm', '17:45 pm',
                '18:00 pm', '18:15 pm', '18:30 pm', '18:45 pm', '19:00 pm', '19:15 pm',
                '19:30 pm', '19:45 pm', '20:00 pm'
            ];
        },
        template: '<select class="form-control" name="hora_inicio" id="horaInicio"><option value="[[time]]" ng-repeat="time in timings">[[time]]</option></select>'
    };
});
agenda.directive('horaFin', function () {
    return {
        restrict: 'E',
        require: 'ngModel',
        replace: true,
        link: function (scope, element, attrs) {
            scope.timings = ['7:00 am', '7:15 am', '7:30 am', '7:45 am', '8:00 am', '8:15 am',
                '8:30 am', '8:45 am', '9:00 am', '9:15 am', '9:30 am', '9:45 am',
                '10:00 am', '10:15 am', '10:30 am', '10:45 am', '11:00 am', '11:15 am', '11:30 am', '11:45 am',
                '12:00 pm', '12:15 pm', '12:30 pm', '12:45 pm', '13:00 pm', '13:15 pm',
                '13:30 pm', '13:45 pm', '14:00 pm', '14:15 pm', '14:30 pm', '14:45 pm',
                '15:00 pm', '15:15 pm', '15:30 pm', '15:45 pm', '16:00 pm', '16:15 pm',
                '16:30 pm', '16:45 pm', '17:00 pm', '17:15 pm', '17:30 pm', '17:45 pm',
                '18:00 pm', '18:15 pm', '18:30 pm', '18:45 pm', '19:00 pm', '19:15 pm',
                '19:30 pm', '19:45 pm', '20:00 pm'
            ];

        },
        template: '<select class="form-control" name="hora_fin" id="horaFin"><option value="[[time]]" ng-repeat="time in timings">[[time]]</option></select>'
    };
});
/*
 *  Panel de nueva cita
 * */
agenda.directive('panelCita', function () {
    return {
        restrict: 'E',
        replace: true,
        template: '<div id="pan-nueva-cita" class="panel [[panel.class_heading]]"> <div class="panel-heading"> <h4 id="heading" class="[[panel.class_text_title]]"><i class="fa fa-calendar-check-o"></i> [[ panel.title_panel ]]</h4> </div> <div class="panel-body" style="[[panel.style_body]];padding-top: 0px"> <ul class="nav nav-tabs"> <li class="active"><a data-toggle="tab" href="#home">Datos cita</a></li> <li><a data-toggle="tab" href="#menu1">Convenio</a></li> </ul> <form action="[[ panel.url ]]" method="post" id="form-cita" name="formCita" ng-submit="submit($event)" novalidate> <input type="text" value="businessHours" name="constraint" ng-show="false"> <div class="tab-content"> <div id="home" class="tab-pane fade in active"> <div class="container-fluid container-full"> <input ng-model="agenda_id" type="hidden" name="agenda_id" value="  '+ AGENDA_ID +'  "> <input ng-model="medico_id" type="hidden" name="medico_id" value="  '+ MEDICO_ID +'  "> <input name="autorizacion" type="hidden" value="[[autorizacion]]"> <input name="fecha_autorizacion" type="hidden" value="[[fecha_autorizacion]]"> <input name="fecha_vence" type="hidden" value="[[fecha_vence]]"> <input name="[[panel.method.name]]" type="hidden" value="[[panel.method.value]]"> <br> <div class="form-group"> <label for=""> Seleccione el paciente:</label> <select id="select-paciente" class="form-control select2" name="idpaciente"> '+OPTIONS_PACIENTE+' </select> </div> <div class="col-sm-6"> <div class="row"> <div class="form-group"> <button type="button" ng-click="showModalDate()" class="btn btn-default"><i class="fa fa-clock-o"></i> Fecha y Hora </button> </div> </div> </div> <div class="col-sm-6"> <h5 style="margin:0px"><b style="font-size:13px">Fecha:</b> <a id="p_fecha" ng-bind="cita.fecha | date: mediumDate"></a></h5> <h5 for=""><b>Desde:</b> <a id="p_desde" ng-bind="horaInicio | date: shortTime"></a></h5> <h5 for=""><b>Hasta:</b> <a id="p_hasta" ng-bind="horaFin | date: shortTime"></a></h5> </div> <div class="row"> <div class="col-xs-10 col-xs-offset-1"> <div class="form-group"> <label for="">Observaciones</label> <textarea id="descripcion" ng-model="cita.descripcion" class="form-control" name="descripcion"cols="30"rows="5"></textarea> </div> </div> </div> <div class="row pull-left" ng-show="panel.buttons.trash"> <div class="col-xs-12"> <div class="form-group"> <button ng-click="eliminarCita([[cita_id]])" type="button" class="btn btn-link"><i   style="font-size: 20px;color: #e74c3c;"class="fa fa-trash pull-left"></i> </button> </div> </div> </div> <div class="row pull-left" ng-show="panel.buttons.cancelar"> <div class="col-xs-12"> <div class="form-group"> <button ng-click="cancelarCita()" style="margin-right: 5px;" type="reset" class="btn btn-default"> <i class="fa fa-minus-circle"></i> Cancelar Cita </button> </div> </div> </div> <div class="row pull-left" ng-show="panel.buttons.modificar"> <div class="col-xs-12"> <div class="form-group"> <button type="submit" class="btn btn-warning"><i class="fa fa-check"></i> Modificar </button> </div> </div> </div> <div class="row" ng-show="panel.buttons.agendar"> <div class="col-xs-12 col-xs-offset-7"> <div class="form-group"> <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agendar </button> </div> </div> </div> </div> </div> <div id="menu1" class="tab-pane fade"> <br> <div class="row"> <div class="col-xs-12"> <div class="form-group"> <label for="">Seleccione el tipo de convenio</label> <select ng-change="eval_convenio()" id="sel_convenio" name="sel_convenio" ng-options="item for item in options_convenio" ng-model="sel_convenio" class="form-control" show-menu-arrow data-style="btn-primary"> </select> </div> </div> </div> <div ng-show="tipo_convenio" class="row"> <div class="col-xs-12"> <div class="form-group"> <label for="">Autorización</label> <input ng-model="autorizacion" type="text" class="form-control"> </div> <div class="form-group"> <label for="">Fecha Autorización</label> <div class="input-group"> <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> <input placeholder="dd/mm/yyyy" ng-model="fecha_autorizacion" name="fecha_autorizacion" type="text"class="form-control datepicker"> </div> </div> <div class="form-group"> <label for="">Fecha Vencimiento</label> <div class="input-group"> <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> <input placeholder="dd/mm/yyyy" ng-model="fecha_vence" name="fecha_vence" type="text" class="form-control datepicker"> </div> </div> </div> </div> </div> </div> </form> </div> </div>'
    }
});
