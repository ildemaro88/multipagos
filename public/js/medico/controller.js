agenda.controller("CtrlApp", function ($scope, $http, $window, $timeout,$q) {
    /*
     * Inicializacion
     */
    // Constructor  -->
    var vm = this; // this == controller

    var Slider = function(){
      this.slider = {
        inicio:'',
        fin:'',
        minValue:'07:00',
        maxValue:'20:00',
        options: {
          stepsArray:[
          {value:'07:00'},
          {value:'08:00'},
          {value:'09:00'},
          {value:'10:00'},
          {value:'11:00'},
          {value:'12:00'},
          {value:'13:00'},
          {value:'14:00'},
          {value:'15:00'},
          {value:'16:00'},
          {value:'17:00'},
          {value:'18:00'},
          {value:'19:00'},
          {value:'20:00'},
          ],
          floor: '07:00',
          ceil: '20:00',
          vertical:false,
          showTicksValues: true,
          disabled:true,
          draggableRange: true,
          minRange: 1,
          onChange: function(sliderId, modelValue, highValue, pointerType) {
            switch(this.id){
              case 1:
              vm.lunSlider.inicio = modelValue;
              vm.lunSlider.fin = highValue;
              break;
              case 2:
              vm.marSlider.inicio = modelValue;
              vm.marSlider.fin = highValue;
              break;
              case 3:
              vm.mieSlider.inicio = modelValue;
              vm.mieSlider.fin = highValue;
              break;
              case 4:
              vm.jueSlider.inicio = modelValue;
              vm.jueSlider.fin = highValue;
              break;
              case 5:
              vm.vieSlider.inicio = modelValue;
              vm.vieSlider.fin = highValue;
              break;
              case 6:
              vm.sabSlider.inicio = modelValue;
              vm.sabSlider.fin = highValue;
              break;
              case 7:
              vm.domSlider.inicio = modelValue;
              vm.domSlider.fin = highValue;
              break;
            }
          },
        }
      }
      return this.slider;
    };
    $scope.activar= function(dia){
      switch(dia){
        case "lunes":
        vm.lunSlider.options.disabled=false;
        break;
        case "martes":
        vm.marSlider.options.disabled=false;
        break;
        case "miercoles":
        vm.mieSlider.options.disabled=false;
        break; 
        case "jueves":
        vm.jueSlider.options.disabled=false;
        break;
        case "viernes":
        vm.vieSlider.options.disabled=false;
        break;
        break;case "sabado":
        vm.sabSlider.options.disabled=false;
        break;
        break;case "domingo":
        vm.domSlider.options.disabled=false;
        break;
      }
      $scope.$broadcast('rzSliderForceRender');
    };
    $scope.desactivar= function(dia){
      switch(dia){
       case "lunes":
       vm.lunSlider.options.disabled=true;
       break;
       case "martes":
       vm.marSlider.options.disabled=true;
       break;
       case "miercoles":
       vm.mieSlider.options.disabled=true;
       break; 
       case "jueves":
       vm.jueSlider.options.disabled=true;
       break;
       case "viernes":
       vm.vieSlider.options.disabled=true;
       break;
       break;case "sabado":
       vm.sabSlider.options.disabled=true;
       break;
       break;case "domingo":
       vm.domSlider.options.disabled=true;
       break;
     }
     $scope.$broadcast('rzSliderForceRender');
   };

   function lunes(id,inicio,fin){
    vm.lunSlider = new Slider();
    vm.lunSlider.options.id=id;
    vm.lunSlider.inicio=inicio;
    vm.lunSlider.fin=fin;
    vm.lunSlider.minValue = inicio;
    vm.lunSlider.maxValue = fin;
  }
  function martes(id,inicio,fin){
    vm.marSlider = new Slider();
    vm.marSlider.options.id=id;
    vm.marSlider.inicio=inicio;
    vm.marSlider.fin=fin;
    vm.marSlider.minValue = inicio;
    vm.marSlider.maxValue = fin;
  }

  function miercoles(id,inicio,fin){
    vm.mieSlider = new Slider();
    vm.mieSlider.options.id=id;
    vm.mieSlider.inicio=inicio;
    vm.mieSlider.fin=fin;
    vm.mieSlider.minValue = inicio;
    vm.mieSlider.maxValue = fin;
  }

  function jueves(id,inicio,fin){
    vm.jueSlider = new Slider();
    vm.jueSlider.options.id=id;
    vm.jueSlider.inicio=inicio;
    vm.jueSlider.fin=fin;
    vm.jueSlider.minValue = inicio;
    vm.jueSlider.maxValue = fin;
  }

  function viernes(id,inicio,fin){
    vm.vieSlider = new Slider();
    vm.vieSlider.options.id=id;
    vm.vieSlider.inicio=inicio;
    vm.vieSlider.fin=fin;
    vm.vieSlider.minValue = inicio;
    vm.vieSlider.maxValue = fin;
  }

  function sabado(id,inicio,fin){
   vm.sabSlider = new Slider();
   vm.sabSlider.options.id=id;
   vm.sabSlider.inicio=inicio;
   vm.sabSlider.fin=fin;
   vm.sabSlider.minValue = inicio;
   vm.sabSlider.maxValue = fin;
 }

 function domingo(id,inicio,fin){
   vm.domSlider = new Slider();
   vm.domSlider.options.id=id;
   vm.domSlider.inicio=inicio;
   vm.domSlider.fin=fin;
   vm.domSlider.minValue = inicio;
   vm.domSlider.maxValue = fin;
 }
 $scope.editar = function(){
  try{
    HORARIO_TRABAJO.forEach(function(currentValue, index, arr){
      switch(parseInt(currentValue.dow["0"])){
        case 1:
        lunes(1,currentValue.start,currentValue.end);
        $("#lunes").trigger( "click" );
        vm.lunSlider.options.disabled=false;
        break;
        case 2:
        martes(2,currentValue.start,currentValue.end);
        $("#martes").trigger( "click" );
        vm.marSlider.options.disabled=false;
        break;
        case 3:
        miercoles(3,currentValue.start,currentValue.end);
        $("#miercoles").trigger( "click" );
        vm.mieSlider.options.disabled=false;
        break;
        case 4:
        jueves(4,currentValue.start,currentValue.end);
        $("#jueves").trigger( "click" );
        vm.jueSlider.options.disabled=false;
        break;
        case 5:
        viernes(5,currentValue.start,currentValue.end);
        $("#viernes").trigger( "click" );
        vm.vieSlider.options.disabled=false;
        break;
        case 6:
        sabado(6,currentValue.start,currentValue.end);
        $("#sabado").trigger( "click" );
        vm.sabSlider.options.disabled=false;
        break;
        case 7:
        domingo(7,currentValue.start,currentValue.end);
        $("#domingo").trigger( "click" );
        vm.domSlider.options.disabled=false;
        break;
      }
    });
  }catch(err){
    console.log(err)
  }
};
/*if(typeof HORARIO_TRABAJO == 'undefined' || HORARIO_TRABAJO == false){
  lunes(1,'07:00','20:00');
  martes(2,'07:00','20:00');
  miercoles(3,'07:00','20:00');
  jueves(4,'07:00','20:00');
  viernes(5,'07:00','20:00');
  sabado(6,'07:00','20:00');
  domingo(7,'07:00','20:00');
}else{
  $scope.editar();
}*/
lunes(1,'07:00','20:00');
martes(2,'07:00','20:00');
miercoles(3,'07:00','20:00');
jueves(4,'07:00','20:00');
viernes(5,'07:00','20:00');
sabado(6,'07:00','20:00');
domingo(7,'07:00','20:00');
$scope.editar();
});// fin controller