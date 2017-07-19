cita.controller("CtrlApp", function ($scope, $http, $window,$timeout) {
  // $scope.initGrid = function initGrid() {
  //     $('.grid').masonry({
  //         // options
  //         itemSelector: '.grid-item',
  //         percentPosition: false,
  //         transitionDuration: '1s',
  //         stagger: 30,
  //         gutter: 10,
  //         animationOptions: {
  //             duration: 400
  //         }
  //     });
  // };
  /*
  * Inicialización
  *
  */

  $scope.init = function () {
    var date = moment(HOY,'YYYY-MM-DD').toDate();
    date.setDate(date.getDate());
    $('#fecha').datepicker({
     language: 'es',
     autoclose: true,
     format: 'dd/mm/yyyy',
     startDate: date
   }).on("changeDate",function(e){
     $scope.citaDisponible(moment(e.date).format('YYYY-MM-DD H:mm'));
   });
    $scope.cDisponible = []; //guarda las citas disponibles procesadas
    $scope.medico_id = 0; //id medico seleccionado
    $scope.medico_titulo = ''; //id medico seleccionado
    $scope.medico_nombre = '';
    $scope.medico_apellido = '';
    $scope.hora_cita_selected =''; // usado para el paso 3
    $scope.start_selected = ''; //datos para envio
    $scope.end_selected = '';//datos para envio
    $scope.f_selected = ''; //almacena la fecha seleccionada
    /*$scope.timings = ['7:00 am', '7:15 am', '7:30 am', '7:45 am', '8:00 am', '8:15 am',
    '8:30 am', '8:45 am', '9:00 am', '9:15 am', '9:30 am', '9:45 am',
    '10:00 am', '10:15 am', '10:30 am', '10:45 am', '11:00 am', '11:15 am', '11:30 am', '11:45 am',
    '12:00 pm', '12:15 pm', '12:30 pm', '12:45 pm', '13:00 pm', '13:15 pm',
    '13:30 pm', '13:45 pm', '14:00 pm', '14:15 pm', '14:30 pm', '14:45 pm',
    '15:00 pm', '15:15 pm', '15:30 pm', '15:45 pm', '16:00 pm', '16:15 pm',
    '16:30 pm', '16:45 pm', '17:00 pm', '17:15 pm', '17:30 pm', '17:45 pm',
    '18:00 pm', '18:15 pm', '18:30 pm', '18:45 pm', '19:00 pm', '19:15 pm',
    '19:30 pm', '19:45 pm'
    ];*/
    $scope.timings =[];
    $("section.content-header").remove();
    $http({
      url: URL_ALL_MEDIC,
      method: 'GET',
      params: {busqueda: $scope.busqueda},
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function (response) {
      if (response.data.medico) {
        $scope.medico = response.data.medico;
        $scope.$watch('medico', function () {
          if ($scope.busqueda != '') {
            $scope.ajuste();
          }
        });
      } else {
        swal("Error!", "Error en la transacción!", "error");
      }
    });
  };
  $scope.init();
/*
* -->
*
*/
/*
* Avance un paso en smartWizard
*
*/
$scope.goForward = function () {
  $("#wizard").smartWizard('goForward');
};
/*
* -->
*
*/
/*
* Recargar la ruta actual
*
*/
$scope.reloadRoute = function () {
  $window.location.reload();
};
/*
* -->
*
*/

/*
* Envio de datos, confirmacion de agendarCita
*
*/
$scope.agendarCita = function () {
  swal({
    title: "Procesando",
    text: 'Espere...',
    showConfirmButton: false
  });
  var f_selected = moment($scope.f_selected,"YYYY-MM-DD H:mm").format('YYYY-MM-DD'),
  start_selected = moment(f_selected+" "+$scope.start_selected,'YYYY-MM-DD H:mm a').format(),
  end_selected = moment(f_selected+" "+$scope.end_selected,'YYYY-MM-DD H:mm a').format();
  // obtener id de paciente basado en id de usuario
  var data = {
    "start":start_selected,
    "end":end_selected,
    "idpaciente":PACIENTE_ID,
    "medico_id":$scope.medico_id,
    "descripcion":'Realizado por el usuario'
  };
  $http({
    url: URL_AGENDA,
    method: 'POST',
    data: data,
    headers: {
      'Content-Type': 'application/json '
    }
  }).then(function (data) {
    if(data.data.response){
      swal({
        title: "Correcto!",
        text: 'Realizado con éxito!',
        timer: 500,
        type:"success",
        showConfirmButton: false
      },function(){
        $scope.reloadRoute();
      });
    }else {
      swal("Error!", "Error en la transacción!", "error");
    }
  });
  //$window.location.reload();
};
/*
* -->
*
*/
/*
* Asignación de especialidad seleccionada al campo de busqueda
*
*/
$scope.buscar = function () {
  $scope.busqueda = $scope.especialidad;
};
/*
* -->
*
*/
/*
* function selected: guarda los datos del médico seleccionado
*@param: int index, string titulo,string nombre,string apellido
*/
$scope.selected = function (index, titulo, nombre, apellido) {
  $scope.check = [];
  $scope.medico_id = index;
  $scope.medico_titulo = titulo;
  $scope.medico_nombre = nombre;
  $scope.medico_apellido = apellido;
  $scope.check[index] = true;
  $("#wizard").smartWizard('goForward');
};
/*
* -->
*
*/
/*

* function selectHorario: guarda los datos del médico seleccionado
* @param  date  start, date end, string estado
* @return
*/
$scope.selectHorario = function(start,end,estado){
  if(estado == 'Disponible'){
    $scope.start_selected = start;
    $scope.end_selected = end;
    $scope.hora_cita_selected = start+'-'+end;
    $scope.goForward();
  }else {
    swal({
      title: "Alerta!",
      text: "Seleccione una cita disponible!",
      type: "warning",
      confirmButtonText: "Ok"
    });
  }
};
/*
* -->
*
*/
$scope.submit = function (e) {
  e.preventDefault();
};
$scope.ajuste = function () {
  wizard();
};
/*
* function citaDisponible: consulta y formatea los datos de citas disponibles
* @param  date  fecha: 2017-03-08 17:00:55
* @return
*/
$scope.functionIsRunning = false; //verificar que la funcion termine de ejecutar
$scope.count = 0;
$scope.citaDisponible = function (fecha) {
  // console.log("entra");
  $scope.count == 0 ? $timeout(countUp, 4000): null ; // inicializar una sola vez el timeout
  $scope.functionIsRunning = true;
  //$scope.loading=true; // muestra estado de elementos de carga
  $scope.show_fecha = typeof fecha != "undefined" ? moment(fecha).format('LL') : moment($scope.hoy).format('LL'); //mostrar la fecha = "2017-03-08 17:02:27"
  $scope.f_selected = fecha;
  $scope.converBusinessHourstToTimings(fecha);

  $http({
    url: URL_CITA_DISPONIBLE,
    method: 'GET',
    params: {
      medico_id: $scope.medico_id,
      fecha: fecha
    },
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    }
  }).then(function (response) {
    //$scope.loading = false;
      var citasDisp = [],resultadoCitas= {}; //guarda las citas disponibles procesadas
      resultadoCitas = response.data.agenda[0].cita;
      // console.log(resultadoCitas)
      //debugger;

      angular.forEach($scope.timings, function (key, value) { // linea de tiempo key == LT
        var obj = {},//objeto temporal para agregar al array cDisponible
        verify = false;
        /* Comparar c/u contra muchos*/
        angular.forEach(resultadoCitas, function (clave, valor) { // recorrer el array de citas
          try {
            var horaLc = moment(clave.start).format('H:mm a'); // hora linea de citas ex: 7:15 am
            // console.log(horaLc + " es igual 1 ???" + key);
            //si es diferente sumarle 15 min y guardarlo como una cita disponible
            if (horaLc == key && clave.estado_cita == 1) { // si es igual la linea de tiempo y linea de cita crear objeto no disponible
              obj = {
                start: key,
                end: moment(clave.end).format('H:mm a'),
                estado: 'No Disponible'
              };
              citasDisp.push(obj);
              // console.log(" SI ES IGUAL 1 ");
              verify = true; //verdadero que existe una cita
            }
          } catch (err) {
            console.log(err)
          }
        });
        // si es false ingresa a poner en el objeto el nuevo item sumado 15 min
        if (!verify) {
          obj = {
            start: key,
            end: moment(key, 'H:mm a').add(0.25, 'hours').format('H:mm a'),
            estado: 'Disponible'
          };
          // console.log(obj.start + " es igual " + obj.end);
          citasDisp.push(obj);
        } else {
          // existe una cita no disponible
          //remover los intervalos internos del objeto
          //saber los objetos internos
          var inicio_ciclo = obj.start;
          var fin_ciclo = obj.end;
          var next_cicle = moment(obj.start, 'H:mm a').add(0.25, 'hours').format('H:mm a');
          //imprimir todos los ciclos internos
          while (next_cicle != fin_ciclo) {
            //eliminar cada ciclo interno del objeto
            //buscar el ciclo next_cicle en el objeto para borrarlo
            angular.forEach($scope.timings, function (ks, vl) { // ks == hora de timings
              if (next_cicle == ks) {
                //remover el objeto siguiente
                $scope.timings.splice(vl,1);
              }
            });
            next_cicle = moment(next_cicle, 'H:mm a').add(0.25, 'hours').format('H:mm a');
          }
        }
      });
      $scope.cDisponible = citasDisp;
      if($scope.cDisponible.length == 0){
          $("#msg").html("<h1 style='margin-top:15px;'>No existen horario disponible para agendar cita</h1>");
      }
      else{  $("#msg").html("");}
    });
  $scope.functionIsRunning = false;
    $scope.count++; // usado para inicializar el timeout una sola vez
  };
// convertir el horario del medico a timings[]
$scope.converBusinessHourstToTimings = function(fecha){
    //consultar horario de trabajo del medico seleccionado
    var day_selected = moment($scope.f_selected,'YYYY-MM-DD').format('dddd'); // martes|| any day
        //fecha = moment($scope.cita.fecha,'DD/MM/YYYY').format('dddd');
        $http({
          url: URL_BUSINESS_HOURS,
          method: 'GET',
          params: {
            medico_id: $scope.medico_id,
            fecha: fecha
          },
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).then(function (response) {
          $scope.timings = [];

          angular.forEach(response.data.businessHours,function(key,value){
           day_business = $scope.map_day(parseInt(key.dow)); // martes
           if(day_selected == day_business ){
              //crear el arreglo timings
              //Object.keys(response.data.businessHours).length
              var hora_inicio = moment(key.start, 'H:mm a').format('H:mm a').toString();
              var hora_fin = moment(key.end, 'H:mm a').format('H:mm a').toString();
              while(hora_inicio != hora_fin){
                // console.log(hora_inicio+" igual "+hora_fin+(hora_inicio == hora_fin))
                $scope.timings.push(hora_inicio);
                hora_inicio = moment(hora_inicio, 'H:mm a').add(0.25, 'hours').format('H:mm a').toString();
              }
              return;
            }
          });
                // console.log($scope.timings)

              });
      };
      $scope.map_day = function(day){
        var result ="";
        switch(day){
          case 1:
          result = "lunes";
          break;
          case 2:
          result = "martes";
          break;
          case 3:
          result = "miércoles";
          break;
          case 4:
          result = "jueves";
          break;
          case 5:
          result = "viernes";
          break;
          case 6:
          result = "sábado";
          break;
          case 7:
          result = "domingo";
          break;

        }
        return result;
      };
/*
*  Sincronizar agenda
* */
var countUp = function() {
  $scope.agendaWorker.load();
  $timeout(countUp, 5000);
};
$scope.agendaWorker = {
  load:function(){
    if(!$scope.functionIsRunning){
      //var fecha = moment($scope.f_selected).format('YYYY-MM-DD h:mm:ss');
      // console.log($scope.f_selected);
      $scope.citaDisponible($scope.f_selected || $scope.hoy);
    }
  }
};

/*
* -->
*
*/
});// fin controller
