agenda.controller("CtrlApp", function ($scope, $http, $window,$timeout) {
    $scope.init = function () {
        $scope.uno = 0;
        $scope.modalCita = function(){
            this.modalTitle ="";
            this.fechaInicio ="";
            this.horaInicio ="";
            this.paciente ="";
            this.observ ="";
            this.sel_convenio ="";
            this.autorizacion ="";
            this.fecha_autorizacion ="";
            this.fecha_vence ="";

        };
        $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next, today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                locale: 'es', // tomado de locale
                buttonIcons: false,                          
                defaultView: 'basicDay',
                //defaultDate: HOY, 
                navLinks: true,
                editable: false,
                eventLimit: true,
                aspectRatio: 2,
                nowIndicator: true,
                titleFormat: 'MMMM D YYYY',
                columnFormat: 'dddd',
                //fixedWeekCount:true,
                //weekNumbers: true,
                timeFormat: 'H:mm',
                events: {
                    url: URL_CITAS
            },
            eventRender: function (event, element) {
                element.click(function () {
                    $("#mod_mostrar_cita").modal('show');
                    // colocar titulo
                    $scope.$apply(function () {
                        var cita = new $scope.modalCita();
                        cita.modalTitle = 'Cita Agendada - '+event.title;
                        cita.fechaInicio = moment(event.start).format('DD/MM/YYYY');
                        cita.horaInicio = moment(event.start).format('h:mm a');
                        cita.paciente = moment(event.start).format('h:mm a');
                        cita.observ = event.detalle_cita;
                        cita.sel_convenio = event.sel_convenio;
                        try{
                            cita.autorizacion = event.convenio.autorizacion ;
                            cita.fecha_autorizacion = event.convenio.fecha_autorizacion;
                            cita.fecha_vence = event.convenio.fecha_vence;
                        }catch(e){}
                        $scope.cita = cita;
                    });
                });
            }
        });
    };
    /*
     *  Sincronizar agenda
     * 
    var countUp = function() {
        $scope.agendaWorker.load();
        $timeout(countUp, 4000);
    };

    $timeout(countUp, 500);*/
    $scope.agendaWorker = {
        load:function(){
            $("#calendar").fullCalendar("refetchEvents");
        }
    };
    /*
     * -->
     *
     * */
    $scope.reloadRoute = function () {
        $window.location.reload();
    };
    $scope.init();//inicializar varios metodos
});
/*agenda.factory("HelloWorldService",['$q',function($q){
 var worker = new Worker('js/doWork.js');
 var defer = $q.defer();
 worker.addEventListener('message', function(e) {
 console.log('Worker said: ', e.data);
 defer.resolve(e.data);
 }, false);
 return {
 doWork : function(myData){
 defer = $q.defer();
 worker.postMessage(agendaWorker); // Send data to our worker.
 return defer.promise;
 }
 };
 }]);*/