@extends("crudbooster::admin_template")
@section("content")
  
<style type="text/css">
@media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    @media screen and (min-width: 1000px) {
        .select2 {
            width: 100% !important;
        }
    }
    .has-error .select2-selection {
        border: 1px solid #a94442;
        border-radius: 4px;
    }
    .modal {
       position: fixed;
       z-index: 999;
       height: 100%;
       width: 100%;
       top: 0;
       left: 0;
       background-color: Black;
       filter: alpha(opacity=40);
       opacity: 0.4;
       -moz-opacity: 0.8;
   }
      .center {
       z-index: 1000;
       margin-top: 200px;
       width: 130px;
       height: 130px;
       background-color: White;
       border-radius: 10px;
       filter: alpha(opacity=100);
       opacity: 1;
       -moz-opacity: 1;
   }
   .center img {
       z-index: 1001;
       height: 64px;
       width: 64px;
       margin-top: 33px;
   }
</style>
    
 <p><a title="Volver" id = "volver" href=""><i class="fa fa-chevron-circle-left"></i>&nbsp; Volver a la Lista de Bancos</a><div id="message">
    </div></p>


<div class = "box" ng-app="MyApp" ng-controller="controllerBanco">
	<div class = "box-body">
		<form id="form_banco" method="POST" action="" name="form_banco" >
			{{ csrf_field() }}
			<div class="form-group row">
	            <div class="col-md-6 div">
	                <label for="nombre_banco" class="control-label">
	                	Banco
						<span class="text-danger" title="Este campo es obligatorio">*</span>
	                </label>                                
	                <select class="form-control" id="nombre_banco" name="nombre_banco" ng-model="nombre_banco">
	                    <option value="">Seleccione:</option>                                                 
                           <option value="Banco Bolivariano">Banco Bolivariano</option>
                           <option value="Banco Pichincha">Banco Pichincha</option>
                           <option value="Banco Internacional">Banco Internacional</option>
                           <option value="Banco del Pacifico">Banco del Pacifico</option>
                           <option value="Banco del Autro">Banco del Autro</option>
                           <option value="Produbanco">Produbanco</option>
                           <option value="Banco de Guayaquil">Banco de Guayaquil</option>                        
	                </select>
	                    
	            </div>	 
	            <div class="col-md-6 div">
	                <label for="nombre_banco" class="control-label">
	                	Titular
						<span class="text-danger" title="Este campo es obligatorio">*</span>
	                </label>                                
	                <input type="text" required="" class="form-control" name="titular" id="titular" value="" ng-model="titular">
	            </div>	 	                
	        </div>

	        <div class="form-group row ">   
	            <div class="col-md-6 div">
			        <label for="cuenta_deposito" class="control-label">
		            	Número de Cuenta 
						<span class="text-danger" title="Este campo es obligatorio">*</span>
		            </label>  
					
	                	
	                	<input type="text" required="" class="form-control" name="cuenta_deposito" id="cuenta_deposito" value="" onkeypress ="return isNumberKey(this);" maxlength="25" ng-model="cuenta_deposito">
	              							
					<div class="text-danger"></div>
					<p class="help-block"></p>
				</div>  

				<div class="col-md-6 div">
	                <label for="tipo_cuenta" class="control-label">
	                	Tipo de Cuenta
						<span class="text-danger" title="Este campo es obligatorio">*</span>
	                </label>                                
	                <select class="form-control" id="tipo_cuenta" name="tipo_cuenta" ng-model="tipo_cuenta">
	                    <option value="">Seleccione:</option>                                                      
                           <option value="Cuenta corriente">Cuenta corriente</option>
                           <option value="Cuenta de ahorro">Cuenta de ahorro</option>
                           
                        
	                </select>
	                    
	            </div>	              
	        </div>
			
		</form>
	</div>
	<div class = "panel-footer">
		<div>
			<input class = "btn btn-success" id="btnSave" type= "button" style= "margin-left: 10px;" value= "Guardar" ng-click= "toggle('{{$operation}}')">
		</div>
	</div>


<!-- HTML del Modal de Loading-->

<div class = "modal" style = "display: none" align = "center">
	<div class = "center">
		<img alt = "" src = "{{asset('img/loading_animation.gif')}}" />
	</div>
</div>


<script type="text/javascript">

function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)){
            
            return false;
        }else{
            if (evt.value[0] == "0") {
        //  return false;
            // se eliminan los ceros delanteros
            evt.value = evt.value.replace(/^0+/, '');
            }
            return true;
        }
    }
   

    $(document).ready(function(){

       

        $.validator.setDefaults( {
            submitHandler: function () {
                alert( "submitted!" );
            }
        });

        

    });

        
   
	//Declaracion de la aplicacion

	 //INICIO DE VALIDACIÓN
    $( "#form_banco" ).validate( {
        rules: {
            nombre_banco: "required",
            cuenta_deposito:"required",
            tipo_cuenta:"required",
            titular:"required",
        },
        messages: {
            nombre_banco: "Seleccione un banco",
            cuenta_deposito:"Introduzca el número de cuenta",
            tipo_cuenta: "Seleccione el tipo de cuenta",
            titular: "Indique el nombre del titular de la cuenta",
            
            

        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            error.addClass( "help-block" );
          // Add the `help-block` class to the error element
          if (element.hasClass('select2-hidden-accessible')) {
              error.insertAfter(element.closest('.has-error').find('.select2'));
          } else if (element.parent('.input-group').length) {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }

        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-md-6" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).parents( ".col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).parents( ".col-md-4" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).parents( ".col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".col-md-6" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).parents( ".col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).parents( ".col-md-4" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).parents( ".col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
        }
    });
    $('.select2-hidden-accessible').on('change', function() {
      if($(this).valid()) {
          $(this).next('span').removeClass('error').addClass('valid');
      }
    });

    ///FIN DE VALIDACIÓN/////
	var app = angular.module('MyApp', [], function ($interpolateProvider)
	{
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	});

	//Declaracion de la url base del proyecto.
	// URL_BASE se declara en el archivo public/js/configServer.js

	app.constant('API_URL', URL_BASE);

	//Implementacion de la controladora de angular

	app.controller("controllerBanco", function ($scope, $http, API_URL)
	{

	//Como inician los campos

	$scope.init = function ()
	{
		$("#volver").attr("href","{{ url('/admin/banco?m=81') }}");
		$scope.cuenta_deposito = "{{($operation == 'update')?$banco->cuenta_deposito :''}}";
		$scope.nombre_banco = "{{($operation == 'update')?$banco->nombre_banco :''}}";
		$scope.tipo_cuenta = "{{($operation == 'update')?$banco->tipo_cuenta :''}}";
		$scope.titular = "{{($operation == 'update')?$banco->titular :''}}";

	};

	 //Ejecuto la funcion anterior init()

	$scope.init();

	//Implementacion de método para crear un JSON a partir de la serializacion del FORM

	$scope.serializeObject = function (obj)
	{
		var o = {};
		var a = obj.serializeArray();
		$.each(a, function ()
		{
			if (o[this.name] !== undefined) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});

		o=JSON.stringify(o);
		o= o.replace(/\r\n/g, "\\n");
		o=JSON.parse(o);

		return o;
	};

	//Implementacion de método que crea un switsh que tiene 2 casos,
	// uno para AÑADIR y otro para ACTUALIZAR.
	// El parametro (operation) puede tomar valores de
	//add o update

	$scope.toggle = function (operation)
	{
		if($("#form_banco").valid()){
			switch (operation) {
				case 'add':

					$(".modal").modal('show');
					console.log($scope.serializeObject($("#form_banco")));
					$http({
						url    : API_URL + 'banco',
						method : 'POST',
						params : $scope.serializeObject($("#form_banco")),
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						}
					}).then(function (response)
					{
						$(".modal").modal('hide');
						if (response.data.response) {
							swal({
								title: "Buen trabajo!",
								text: "Se ha guardado exitosamente!",
								type: "success",
								showCancelButton: false,
								confirmButtonClass: "btn-succes",
								confirmButtonText: "OK",
								closeOnConfirm: true
							},
							function(){
								$(".modal").modal('show');
								window.location = "{{ url('/admin/banco?m=81') }}";
							});
						} else {
							swal("Error", "¡No se guardó!", "error");
						}
					});

					break;

				case 'update':

					$(".modal").modal('show');

					$http({
						url    : API_URL + 'banco/{{$banco->id}}',
						method : 'PUT',
						params : $scope.serializeObject($("#form_banco")),
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						}
					}).then(function (response)
					{
						$(".modal").modal('hide');
						if (response.data.response) {
							swal({
								title: "Buen trabajo!",
								text: "Actualización exitosa!",
								type: "success",
								showCancelButton: false,
								confirmButtonClass: "btn-succes",
								confirmButtonText: "OK",
								closeOnConfirm: true
							},
							function(){
								$(".modal").modal('show');
								window.location = "{{ url('/admin/banco?m=81') }}";
							});
						} else {
							swal("Error", "No se actualizó", "error");
						}
					});
					break;
			}
		}
	}
});



</script>
@endsection