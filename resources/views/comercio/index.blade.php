@extends("crudbooster::admin_template")
@section("content")
   
    
 <p><a title="Volver" id = "volver" href=""><i class="fa fa-chevron-circle-left"></i>&nbsp; Volver a la Lista de Empresas</a><div id="message">
    </div></p>

    
<div class = "box" ng-app="MyApp" ng-controller="controllerEmpresa">
	<div class = "box-body">
		<form id="form_empresa" method="POST" action="" name="form_empresa" >
			{{ csrf_field() }}
			<div class="form-group row">
	            <div class="col-md-6">
	                <label for="nombre" class="control-label">
	                	Nombre
						<span class="text-danger" title="Este campo es obligatorio">*</span>
	                </label>                                
	                <input type="text" class="form-control" id="nombre" name="nombre" ng-model="nombre">
	                    
	            </div>
	            <div class="col-md-6">
	                <label for="razon_social" class="control-label">
	                	Razón Social
						<span class="text-danger" title="Este campo es obligatorio">*</span>
	                </label>                                
	                <input type="text" class="form-control" id="razon_social" name="razon_social" ng-model="razon_social">
	                    
	            </div>                                  
	            
	        </div>
	        <div class="form-group row">                                
	            <div class="col-md-6">
	                <label class="control-label" for="id_tipo_documento">Tipo de Documento</label>
	                <span class="text-danger" title="Este campo es obligatorio">*</span>
	                <select class="form-control" id="id_tipo_documento" name="id_tipo_documento" ng-model="id_tipo_documento">
	                    <option value="">Seleccione:</option>                                        
	                    <option value="1">RUC</option>
	                    <option value="2">CEDULA</option>
	                </select>
	                
	            </div>                                
	            <div class="col-md-6">
	                <label class="control-label" for="codigo_documento">Número de Documento</label>
	                <span class="text-danger" title="Este campo es obligatorio">*</span>
	                <input type="text" class="form-control" id="codigo_documento" name="codigo_documento" ng-model="codigo_documento">
	            </div>
	        </div>  
	        <div class="form-group row">
	           <div class="col-md-6">
	                <label class="control-label" for="id_tipo">Tipo de Empresa</label>
	                <span class="text-danger" title="Este campo es obligatorio">*</span>
	                <select class="form-control" id="id_tipo" name="id_tipo" ng-model="id_tipo">
	                    <option value="">Seleccione:</option>                                        
	                    <option value="1">Sub Distribuidor</option>
	                    <option value="2">Comercio</option>
	                </select>
	           </div>
	          
	            <div class="col-md-6">
	                <label for="id_estado_empresa" class="control-label">Estado</label>
	                <span class="text-danger" title="Este campo es obligatorio">*</span>      
	                <select class="form-control" id="id_estado_empresa" name="id_estado_empresa" ng-model="id_estado_empresa">
	                    <option value="">Seleccione:</option>                                        
	                    <option value="1">Activa</option>
	                    <option value="2">Inactiva</option>
	                </select>
	            </div>
	        </div>
	        <div class="form-group row">
	            <div class="col-md-6">
	                <label class="control-label" for="telefono">Teléfono</label>                                
	                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduzca teléfono local" ng-model="telefono">
	            </div>
	            <div class="col-md-6">
	                <label class="control-label" for="telefono_celular">Teléfono celular</label>                                
	                <input type="text" class="form-control" id="telefono_celular" name="telefono_celular" placeholder="Introduzca teléfono celular" ng-model="telefono_celular">
	            </div>
	        </div>
	       <div class="form-group row">
	            <div class="col-md-6">
	                <label class="control-label" for="region">Región</label> 
	                <span class="text-danger" title="Este campo es obligatorio">*</span>      
	                <select class="form-control" id="region" name="region" ng-model="region">
	                    <option value="">Seleccione:</option>                                        
	                    <option value="1">Activa</option>
	                    <option value="2">Inactiva</option>
	                </select>
	            </div>
	            <div class="col-md-6">
	                <label class="control-label" for="provincia">Provincia</label> 
	                <span class="text-danger" title="Este campo es obligatorio">*</span>      
	                <select class="form-control" id="provincia" name="provincia" ng-model="provincia">
	                    <option value="">Seleccione:</option>                                        
	                    <option value="1">Activa</option>
	                    <option value="2">Inactiva</option>
	                </select>
	            </div>
	        </div> 
	        <div class="form-group row">
	            <div class="col-md-12">
	               <label class="control-label" for="ciudad">Ciudad</label> 
	                <span class="text-danger" title="Este campo es obligatorio">*</span>      
	                <select class="form-control" id="ciudad" name="ciudad" ng-model="ciudad">
	                    <option value="">Seleccione:</option>                                        
	                    <option value="1">Activa</option>
	                    <option value="2">Inactiva</option>
	                </select>
	            </div>
	            
	        </div>                            
	        <div class="form-group row">
	            <div class="col-md-12">
	                <label for="direccion_principal" class="control-label">Dirección Principal</label>                                
	                <textarea type="text" class="form-control" id="direccion_principal" name="direccion_principal" placeholder="Cargo en la Delegación" ng-model="direccion_principal"> </textarea> 
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

	app.controller("controllerEmpresa", function ($scope, $http, API_URL)
	{

	//Como inician los campos

	$scope.init = function ()
	{
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
		switch (operation) {
			case 'add':

				$(".modal").modal('show');
				console.log($scope.serializeObject($("#form_empresa")));
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
});


</script>
@endsection