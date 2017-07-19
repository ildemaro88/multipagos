@extends("crudbooster::admin_template")
@section("content")
{!! header("Access-Control-Allow-Origin: *"); !!}
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
    
 <p><a title="Volver" id = "volver" href=""><i class="fa fa-chevron-circle-left"></i>&nbsp; Volver a la Lista de Transacciones</a><div id="message">
    </div></p>



<div class = "box" ng-app="MyApp" ng-controller="controllerAcreditacion">
    <div class = "box-body">
        <form id="form_acreditacion" method="POST" action="" name="form_acreditacion" >
            {!! csrf_field() !!}
            <div class="form-group row">
                    <div class="col-md-6">
                        <label for="id_producto" class="control-label">
                            Banco
                            <span class="text-danger" title="Este campo es obligatorio">*</span>
                        </label>                                
                        <select class="form-control" id="id_producto" name="id_producto" ng-model="id_producto">
                            <option value="">Seleccione:</option>                                        
                            @foreach($bancos as $p)
                               <option value="{{$p->id}}">{{$p->nombre_banco}}</option>
                            @endforeach
                        </select>            


                    </div>                                
                    <div class="col-md-6">
                        <label for="codigo_cliente" class="control-label">
                            Número de comprobante
                            <span class="text-danger" title="Este campo es obligatorio">*</span>
                        </label>
                        <input type="text" onkeypress="return isNumberKey(this);" class="form-control" id="codigo_cliente" name="codigo_cliente" placeholder="Introduzca número de comprobante" ng-model="codigo_cliente">
                    </div>
                </div>
                <div class="form-group row">                                
                    <div class="col-md-6">
                        <label class="control-label" for="monto">
                            Monto
                            <span class="text-danger" title="Este campo es obligatorio">*</span>
                        </label>
                        <input type="text" onkeypress="return isNumberKey2(this);" class="form-control" id="monto" name="monto" placeholder="Introduzca el monto a solicitar" ng-model="monto">
                    </div>                                
                    <div class="col-md-6">
                        <label class="control-label" for="trx">
                            Comentario
                            
                        </label>
                        <input type="text" class="form-control" id="trx" name="trx" placeholder="" ng-model="trx">
                        <input type="hidden" class="form-control" id="id_estado" name="id_estado" ng-model="id_estado" ng-checked="id_estado">
                        <input type="hidden" value="2" class="form-control" id="id_tipo_transaccion" name="id_tipo_transaccion" ng-model="id_tipo_transaccion" ng-checked="id_tipo_transaccion">
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
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

     return true;
    }

    function isNumberKey2(evt)
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

        

        $('#id_producto').on('change',function(){       
            if($("#id_producto option:selected").text() == "EFECTIVO"){
                $("#codigo_cliente").val($("#id_producto option:selected").text());
                $("#codigo_cliente").attr("readonly","readonly");
                //alert("hola");
            }else{
                $("#codigo_cliente").removeAttr("readonly");
                $("#codigo_cliente").val("");
            }
            /*
            var montos = "{{$montos}}";     
            montos=montos.replace(/&quot;/g,'"');

            montos = JSON.stringify(eval("(" + montos + ")"));
            montos= JSON.parse(montos);

            $('#monto')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Seleccione:</option>')
                
            ;
            $("#monto").val("").trigger("change");
                $.each(montos, function(id,values){
                    if(values.id_tarifa == $("#producto").val())
                $("#monto").append('<option value="'+values.id+'">'+values.descripcion+'</option>');
            });      */                        
        });

    });
        
    $("#id_producto").select2();
    $("#producto").select2();
    //$("#monto").select2();
    $("#id_tipo_documento").select2();
    $("#id_tipo").select2();

        

    //INICIO DE VALIDACIÓN
    $( "#form_acreditacion" ).validate( {
        rules: {
            id_producto: "required",
            producto:"required",
            monto: "required",
            codigo_cliente:"required",
            

        },
        messages: {
            id_producto: "Seleccione un banco",
            producto:"Seleccione un producto",
            monto: "Introduzca el monto a solicitar",
            codigo_cliente:"Ingrese el número de comprobante",
            

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

    app.controller("controllerAcreditacion", function ($scope, $http, API_URL)
    {

        //Como inician los campos

        $scope.init = function ()
        {
            $("#volver").attr("href","{{ url('/admin/transacciones?m=69') }}");
            $scope.codigo_cliente = "{{($operation == 'update')?$acreditacion->codigo_cliente :''}}";
            $scope.monto = "{{($operation == 'update')?$acreditacion->monto :''}}";
            $scope.trx = "{{($operation == 'update')?$acreditacion->trx :''}}";
            $scope.id_estado = "{{($operation == 'update')?$acreditacion->id_estado :''}}";
            $scope.id_tipo_transaccion = "{{($operation == 'update')?$acreditacion->id_tipo_transaccion :''}}";
            $scope.id_producto = "{{($operation == 'update')?$acreditacion->id_producto :''}}";
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
            if($("#form_acreditacion").valid()){
                switch (operation) {                
                    case 'add':
                        $("#id_estado").val("1");
                        $(".modal").modal('show');
                        console.log($scope.serializeObject($("#form_acreditacion")));
                        $http({
                            url    : API_URL + 'acreditacion/solicitud',
                            method : 'POST',
                            params : $scope.serializeObject($("#form_acreditacion")),
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
                                    window.location = "{{ url('/admin/acreditacion?m=6') }}";
                                });
                            } else {
                                swal("Error", "¡No se guardó!", "error");
                            }
                        });
                    break;

                    case 'update':

                        $(".modal").modal('show');

                        $http({
                            url    : API_URL + 'acreditacion/solicitud/{{$acreditacion->id}}',
                            method : 'PUT',
                            params : $scope.serializeObject($("#form_acreditacion")),
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
                                    window.location = "{{ url('/admin/acreditacion?m=6') }}";
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