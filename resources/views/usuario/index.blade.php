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
	.div{
		/*clear: both;*/
		margin-bottom: 10px;
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
    
 <p><a title="Volver" id = "volver" href=""><i class="fa fa-chevron-circle-left"></i>&nbsp; Volver a la Lista de Empresas</a><div id="message">
    </div></p>


<div class = "box" ng-app="MyApp" ng-controller="controllerUsuario">
	<div class = "box-body">
		<form id="form_usuario" method="POST" action="" name="form_usuario" >
			{{ csrf_field() }}
			<div class="form-group  row">
	            <div class="col-md-6 ">
	                <label for="name" class="control-label">
	                	Nombre
						<span class="text-danger" title="Este campo es obligatorio">*</span>
	                </label>                                
	                <input type="text" class="form-control" id="name" placeholder="Nombre del Usuario" name="name" ng-model="name">
	                    
	            </div>	    
	            <div class="col-md-6 ">
			        <label for="email" class="control-label">
		            	Correo 
						<span class="text-danger" title="Este campo es obligatorio">*</span>
		            </label>  
					<div class="input-group">
	                	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	                	<input type="text" placeholder="Introduzca correo electrónico" title="Email" required="" class="form-control" name="email" id="email" ng-model="email">
	              	</div>							
					<div class="text-danger"></div>
					<p class="help-block"></p>
				</div>  	           
	        </div>
	      
	        <div class="form-group row">
	           <div class="col-md-6 ">
	                <label class="control-label" for="password">Contraseña</label>
	                @if($operation == 'add')
	                <span class="text-danger" title="Este campo es obligatorio">*</span>
	                @endif
	                <input type="password" id="password" title="Contraseña" required="" class="form-control" name="password" ng-model="password">
	           </div>
	          
	            <div class="col-md-6 ">
	                <label for="id_empresa" class="control-label">Empresa</label>
	                <span class="text-danger" title="Este campo es obligatorio">*</span>      
	                <select class="form-control" id="id_empresa" name="id_empresa" ng-model="id_empresa">
	                    <option value="">Seleccione:</option>                                        
	                    @foreach($empresas as $p)
                           <option value="{{$p->id}}">{{$p->nombre}}</option>
                        @endforeach
	                </select>
	            </div>
	        </div>
	        <div class="form-group row ">
	            <div class="col-md-6 div">
	                <label class="control-label" for="telefono_user">Teléfono</label>
	                <span class="text-danger" title="Este campo es obligatorio">*</span>                                
	                <input onkeypress ="return isNumberKey(this);" type="text" class="form-control" id="telefono_user" name="telefono_user" placeholder="Introduzca número de teléfono " ng-model="telefono_user">
	            </div>
	            <div class="col-md-6 div">
	                <label class="control-label" for="direccion_user">Dirección</label>  
	                <span class="text-danger" title="Este campo es obligatorio">*</span>       			                       
	                <input type="text" class="form-control" id="direccion_user" name="direccion_user" placeholder="Introduzca la dirección" ng-model="direccion_user">
	                 <input type="hidden" value="uploads/2017-01/d051c9540ea41af6f27dad1ba6f77c0a.jpg" id="photo" title="Photo" required="" class="form-control" name="photo" ng-checked="photo">
	                 <input type="hidden" value="{{$operation}}" id="operation" title="Photo" required="" class="form-control" name="operation" ng-checked="operation">
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
            return true;
        }
    }
		//Declaracion de la aplicacion
	$(document).ready(function(){
		$.validator.setDefaults( {
			submitHandler: function () {
				alert( "submitted!" );
			}
		} );

		//INICIO DE VALIDACIÓN
    	$( "#form_usuario" ).validate( {
			rules: {
				name: "required",
		        email:"required",
		        password: { required:
		        	function(){
				        if($("#operation").val() == 'add'){
				            return true;
				        }
				        else
				        {
				            return false;
				        }
				    }
		        },
		        id_empresa:"required",
		        direccion_user:"required",
		        telefono_user: {
		        	required: true,
		        	min:9,
		        },		        

			},
			messages: {
				name: "Introduzca el nombre del usuario",
		        email:"Introduzca el correo electrónico del usuario",
		        password: "Introduzca una contraseña",
		        codigo_documento:"Ingrese el número de documento",
		        id_empresa: "Seleccione la empresa",		        
		        telefono_user: "Introduzca un número telefónico",
		        direccion_user:{
		        	required:"Introduzca la dirección del usuario",
		        	min:"Introduzca un número telefónico valido",},
		        

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
                $( element ).parents( ".col-md-3" ).addClass( "has-error" ).removeClass( "has-success" );
                $( element ).parents( ".col-md-12" ).addClass( "has-error" ).removeClass( "has-success" );
    		},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".col-md-6" ).addClass( "has-success" ).removeClass( "has-error" );
                $( element ).parents( ".col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
                $( element ).parents( ".col-md-3" ).addClass( "has-success" ).removeClass( "has-error" );
                $( element ).parents( ".col-md-12" ).addClass( "has-success" ).removeClass( "has-error" );
			}
		});
		$('.select2-hidden-accessible').on('change', function() {
		  if($(this).valid()) {
		      $(this).next('span').removeClass('error').addClass('valid');
		  }
		});

		///FIN DE VALIDACIÓN/////
		
		$('#region').on('change',function(){			
			
			$('#baba').prop('selectedIndex',0);
			var region = $('#region').val();
			$.ajax({
				type: 'POST',            
	            url: URL_BASE+'empresa/provincias/'+region+'',
	            dataType: 'json',
	            contentType: 'application/x-www-form-urlencoded',
	            success: function (data) {
	            	$('#provincia')
			    .find('option')
			    .remove()
			    .end()
			    .append('<option value="">Seleccione:</option>')
			    
			;
			 $("#provincia").trigger("change");
	            	$.each(data, function(id,value){
						$.each(value, function(id,values){
						$("#provincia").append('<option value="'+values.id+'">'+values.descripcion+'</option>');
					    });
				    });
				    $("#provincia").trigger("change");
	                
	            },
	            error: function(jqXmlHttpRequest, textStatus, errorThrown) { alert("Error leyendo datos."+errorThrown); },
			});
		});
	});
	
		//Declaracion de la aplicacion

	 var app = angular.module('MyApp', [], function ($interpolateProvider)
	{
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	});

	//Declaracion de la url base del proyecto.
	// URL_BASE se declara en el archivo public/js/configServer.js

	app.constant('API_URL', URL_BASE);

	//Implementacion de la controladora de angular

	app.controller("controllerUsuario", function ($scope, $http, API_URL)
	{

	//Como inician los campos

		$scope.init = function ()
		{
			$scope.name = "{{($operation == 'update')?$usuario->name :''}}";
			$scope.email = "{{($operation == 'update')?$usuario->email :''}}";
			$scope.photo = "{{($operation == 'update')?$usuario->photo :''}}";
			//$scope.password = "{{($operation == 'update')?$usuario->password :''}}";
			$scope.telefono_user = "{{($operation == 'update')?$usuario->telefono_user :''}}";
			$scope.direccion_user = "{{($operation == 'update')?$usuario->direccion_user :''}}";
			$scope.id_cms_privileges = "{{($operation == 'update')?$usuario->id_cms_privileges :''}}";
			$scope.id_empresa = "{{($operation == 'update')?$usuario->id_empresa :''}}";
			
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
			if($("#form_usuario").valid()){
				switch (operation) {
					case 'add':

						$(".modal").modal('show');
						console.log($scope.serializeObject($("#form_usuario")));
						$http({
							url    : API_URL + 'users',
							method : 'POST',
							params : $scope.serializeObject($("#form_usuario")),
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
									window.location = "{{ url('/admin/users?m=17') }}";
								});
							} else {
								swal("Error", "¡No se guardó!", "error");
							}
						});

						break;

					case 'update':

						$(".modal").modal('show');

						$http({
							url    : API_URL + 'users/{{$usuario->id}}',
							method : 'PUT',
							params : $scope.serializeObject($("#form_usuario")),
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
									window.location = "{{ url('/admin/users?m=17') }}";
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