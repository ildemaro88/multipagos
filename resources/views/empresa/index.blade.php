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
    
 <p><a title="Volver" id = "volver" href=""><i class="fa fa-chevron-circle-left"></i>&nbsp; Volver a la Lista de Empresas</a><div id="message">
    </div></p>

    
<div class = "box" ng-app="MyApp" ng-controller="controllerEmpresa">
	<div class = "box-body">
		<form id="form_empresa" method="POST" action="" name="form_empresa" >
			{{ csrf_field() }}

			<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active empresa"><a data-toggle="tab" href="#empresa">Empresa</a></li>
                    <li class="productos"><a data-toggle="tab" href="#productos">Productos</a></li>                   
                </ul>
            </div>

            <div class="tab-content">
                    <!--Inicio pestaña medicoPaciente-->
                <div id="empresa" class="tab-pane fade in active ">

					<div class="form-group row">
			            <div class="col-md-6">
			                <label for="nombre" class="control-label">
			                	Nombre
								<span class="text-danger" title="Este campo es obligatorio">*</span>
			                </label>                                
			                <input type="text" class="form-control" id="nombre" placeholder="Nombre de la empresa" name="nombre" ng-model="nombre">
			                    
			            </div>
			            <div class="col-md-6">
			                <label for="razon_social" class="control-label">
			                	Razón Social
								<span class="text-danger" title="Este campo es obligatorio">*</span>
			                </label>                                
			                <input type="text" class="form-control" id="razon_social" placeholder="Razón social de la empresa" name="razon_social" ng-model="razon_social">
			                    
			            </div>                                  
			            
			        </div>
			        <div class="form-group row">                                
			            <div class="col-md-6">
			                <label class="control-label" for="id_tipo_documento">Tipo de Documento</label>
			                <span class="text-danger" title="Este campo es obligatorio">*</span>
			                <select class="form-control" id="id_tipo_documento" name="id_tipo_documento" ng-model="id_tipo_documento">
			                    <option value="">Seleccione:</option>                                        
			                    @foreach($tipo_documento as $p)
		                           <option value="{{$p->id}}" >{{$p->tipo}}</option>
		                        @endforeach
			                </select>
			                
			            </div>                                
			            <div class="col-md-6">
			                <label class="control-label" for="codigo_documento">Número de Documento</label>
			                <span class="text-danger" title="Este campo es obligatorio">*</span>
			                <input maxlength="13" onkeypress ="return isNumberKey(this);" type="text" placeholder="Introduzca número de documento" class="form-control" id="codigo_documento" name="codigo_documento" ng-model="codigo_documento">
			            </div>
			        </div>  
			        <div class="form-group row">
			           <div class="col-md-6">
			                <label class="control-label" for="id_tipo">Tipo de Empresa</label>
			                <span class="text-danger" title="Este campo es obligatorio">*</span>
			                <select class="form-control" id="id_tipo" name="id_tipo" ng-model="id_tipo">
			                    <option value="">Seleccione:</option>                                        
			                    @foreach($tipo_empresa as $p)
		                           <option value="{{$p->id}}" >{{$p->tipo}}</option>
		                        @endforeach
			                </select>
			           </div>
			          
			            <div class="col-md-6">
			                <label for="id_estado_empresa" class="control-label">Estado</label>
			                <span class="text-danger" title="Este campo es obligatorio">*</span>      
			                <select class="form-control" id="id_estado_empresa" name="id_estado_empresa" ng-model="id_estado_empresa">
			                    <option value="">Seleccione:</option>                                        
			                    @foreach($estado_empresa as $p)
		                           <option value="{{$p->id}}" >{{$p->estado}}</option>
		                        @endforeach
			                </select>
			            </div>
			        </div>
			        <div class="form-group row">
			            <div class="col-md-6">
			                <label class="control-label" for="telefono">Teléfono</label>                                
			                <input maxlength="9" onkeypress ="return isNumberKey(this);" type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduzca teléfono local" ng-model="telefono">
			            </div>
			            <div class="col-md-6">
			                <label class="control-label" for="telefono_celular">Teléfono celular</label>                                
			                <input maxlength="9" onkeypress ="return isNumberKey(this);" type="text" class="form-control" id="telefono_celular" name="telefono_celular" placeholder="Introduzca teléfono celular" ng-model="telefono_celular">
			            </div>
			        </div>
			        <div class="form-group row">
			            <div class="col-md-6">
			                <label class="control-label" for="region">Región</label> 
			                <span class="text-danger" title="Este campo es obligatorio">*</span>      
			                <select class="form-control" id="region" name="region" ng-model="region">
			                    <option value="">Seleccione:</option>                                        
			                    @foreach($regiones as $p)
		                           <option value="{{$p->id}}" >{{$p->descripcion}}</option>
		                        @endforeach
			                </select>
			            </div>
			            <div class="col-md-6">
			                <label class="control-label" for="provincia">Provincia</label> 
			                <span class="text-danger" title="Este campo es obligatorio">*</span>      
			                <select class="form-control" id="provincia" name="provincia" ng-model="provincia">
			                    <option value="">Seleccione:</option>
			                    @if($operation == 'update')
									@foreach($provincias as $p)
		                           		<option value="{{$p->id}}" >{{$p->descripcion}}</option>
		                        	@endforeach
			                    @endif                                                         
			                </select>
			            </div>
			        </div> 	                                  
			        <div class="form-group row">
			            <div class="col-md-12">
			                <label for="direccion_principal" class="control-label">Dirección Principal</label>
			                <span class="text-danger" title="Este campo es obligatorio">*</span>                               
			                <textarea type="text" class="form-control" id="direccion_principal" name="direccion_principal" placeholder="Introduzca dirección principal" ng-model="direccion_principal"> </textarea> 
			            </div>                                
			        </div>			            
			    </div> 
				 
				<div id="productos" class="tab-pane fade  ">
					@foreach($productos as $producto)
						<div class="panel-group col-md-6 laboratorio" id="accordion">
	                        <div class="panel panel-default">
	                          <div class="panel-heading">
	                            <h4 class="panel-title">
	                              <a class="opcion" data-parent="#accordion" data-toggle="collapse" href="#{{$producto->id}}">
	                                {{$producto->nombre}}</a>
	                            </h4>
	                          </div>
	                          <div id="{{$producto->id}}" class="panel-collapse collapse in">
	                            <table>
	                              <tbody><tr>
	                                <td>
	                                <label class="checkbox-inline">
	                                 
                                        <input type="checkbox" class="producto" data="{{$producto->id}}" id="estatus_{{$producto->id}}" ng-checked="estatus_{{$producto->id}}" name="{{$producto->id}}[estatus]"> Activo
                                    
                                    </label>
	                                </td>
	                                <td>
	                                  <label class="checkbox-inline">Porcentaje</label>
	                                  <input type="text" class="porcentaje" id="porcentaje_{{$producto->id}}" ng-model="porcentaje_{{$producto->id}}" name="{{$producto->id}}[porcentaje]">
	                                </td>
	                              </tr>	                              
	                            </tbody></table>
	                          </div>
	                        </div>
	                    </div>   
	                @endforeach              
				</div> 
			</div>                			
		</form>
	</div>
	<div class = "panel-footer">
		<div>
			<input class = "btn btn-success" id="btnSave" type= "button" style= "margin-left: 0px;" value= "Guardar" ng-click= "toggle('{{$operation}}')">
		</div>
	</div>


<!-- HTML del Modal de Loading-->

<div class = "modal" style = "display: none" align = "center">
	<div class = "center">
		<img alt = "" src = "{{asset('img/loading_animation.gif')}}" />
	</div>
</div>

<script type="text/javascript">

	$("#region").select2();
    $("#provincia").select2();
    $("#id_estado_empresa").select2();
    $("#id_tipo_documento").select2();
    $("#id_tipo").select2();

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
    	$( "#form_empresa" ).validate( {
			rules: {
				nombre: "required",
		        razon_social:"required",
		        id_tipo_documento: "required",
		        codigo_documento:{
		        	required: true,
		        	minlength:10,
		        },		        
		        id_tipo: "required",
		        id_estado_empresa:"required",
		        telefono: { minlength:
		        	function(){
				        if($("#telefono").val().length > 0){
				            return 9;
				        }
				        else
				        {
				            return 0;
				        }
				    }
		        },
		        telefono_celular:{
		        	required: true,
		        	minlength:9,
		        },		        
		        region: "required",
		        provincia:"required",
		        direccion_principal:"required",

		        

			},

			
			messages: {
				nombre: "Introduzca el nombre de la empresa",
		        razon_social:"Introduzca la razon social de la empresa",
		        id_tipo_documento: "Seleccione el tipo de documento",
		        codigo_documento:{
		        	required:"Ingrese el número de documento",
		        	minlength:"Introduzca un número de documento valido",},
		        id_tipo: "Seleccione el tipo de empresa",
		        id_estado_empresa:"Seleccione estado de la empresa",
		        telefono:"Introduzca un número telefónico valido",
		        telefono_celular:{
		        	required:"Introduzca un número telefónico",
		        	minlength:"Introduzca un número telefónico valido",},
		        region: "Seleccione la región donde se encuentra la empresa",
		        provincia:"Seleccione la provincia",
		        direccion_principal:"Introduzca la dirección principal de la empresa",

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
	 var app = angular.module('MyApp', [], function ($interpolateProvider)
	{
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	});

	//Declaracion de la url base del proyecto.
	// URL_BASE se declara en el archivo public/js/configServer.js

	app.constant('API_URL', URL_BASE);

	//Implementacion de la controladora de angular

	app.controller("controllerEmpresa", function ($scope, $http, API_URL)
	{

		//Como inician los campos

		$scope.init = function ()
		{
			$("#volver").attr("href","{{ url('/admin/empresa?m=12') }}");
			if("{{$operation == 'update'}}"){
				
				var examenes =  "{{$productos_activos}}"

	            examenes=examenes.replace(/&quot;/g,'"');

	             examenes = JSON.stringify(eval("(" + examenes + ")"));
	             examenes= JSON.parse(examenes);

	            console.log(examenes);

	            angular.forEach(examenes, function(value, key) {

	               $scope['estatus_'+value.id_producto] = value.estatus;
	               $scope['porcentaje_'+value.id_producto] = value.porcentaje;
	              console.log(value.id);


	            });

	            $("#region").val("{{$empresa->region}}").trigger("change");
	            $("#provincia").val("{{$empresa->provincia}}").trigger("change");
			    $("#id_estado_empresa").val("{{$empresa->id_estado_empresa}}").trigger("change");
			    $("#id_tipo_documento").val("{{$empresa->id_tipo_documento}}").trigger("change");
			    $("#id_tipo").val("{{$empresa->id_tipo}}").trigger("change");
	            
	          }else{
	          	$("#region").val("").trigger("change");
	            $("#provincia").val("").trigger("change");
			    $("#id_estado_empresa").val("").trigger("change");
			    $("#id_tipo_documento").val("").trigger("change");
			    $("#id_tipo").val("").trigger("change");
	            
	          }


			$scope.nombre = "{{($operation == 'update')?$empresa->nombre :''}}";
			$scope.razon_social = "{{($operation == 'update')?$empresa->razon_social :''}}";
			$scope.codigo_documento = "{{($operation == 'update')?$empresa->codigo_documento :''}}";
			$scope.telefono = "{{($operation == 'update')?$empresa->telefono :''}}";
			$scope.telefono_celular = "{{($operation == 'update')?$empresa->telefono_celular :''}}";
			$scope.direccion_principal = "{{($operation == 'update')?$empresa->direccion_principal :''}}";
			$scope.id_tipo_documento = "{{($operation == 'update')?$empresa->id_tipo_documento :''}}";
			$scope.id_tipo = "{{($operation == 'update')?$empresa->id_tipo :''}}";
			$scope.id_estado_empresa = "{{($operation == 'update')?$empresa->id_estado_empresa :''}}";
			$scope.region = "{{($operation == 'update')?$empresa->region :''}}";
			$scope.provincia = "{{($operation == 'update')?$empresa->provincia :''}}";
			$scope.ciudad = "{{($operation == 'update')?$empresa->ciudad :''}}";
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
			if($("#form_empresa").valid()){
				switch (operation) {
					case 'add':

						$(".modal").modal('show');
						console.log($scope.serializeObject($("#form_empresa")));
						//die();
						$http({
							url    : API_URL + 'empresa',
							method : 'POST',
							params : $scope.serializeObject($("#form_empresa")),
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
									window.location = "{{ url('/admin/empresa?m=3') }}";
								});
							} else {
								swal("Error", "¡No se guardó!", "error");
							}
						});
					break;
					case 'update':

						$(".modal").modal('show');
						console.log($scope.serializeObject($("#form_empresa")));
						$http({
							url    : API_URL + 'empresa/{{$empresa->id}}',
							method : 'PUT',
							params : $scope.serializeObject($("#form_empresa")),
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
									window.location = "{{ url('/admin/empresa?m=3') }}";
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