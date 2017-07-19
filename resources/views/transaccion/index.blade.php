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
    
 <p><a title="Volver" id = "volver" href=""><i class="fa fa-chevron-circle-left"></i>&nbsp; Ver lista de Transacciones </a> Saldo Acreditado: $ {{$saldo->acreditado>0?$saldo->acreditado:0}}  - Comisión : ${{$saldo->comision>0?$saldo->comision:0}} - <a style="color: #00AA00;font-weight: 900;">Total: ${{$saldo->saldo>0?$saldo->saldo:0}}</a><div id="message">
    </div></p>

<div class = "box" ng-app="MyApp" ng-controller="controllerTransaccion">
    <div class = "box-body">
        <form id="form_transaccion" method="POST" action="" name="form_transaccion" >
            
            <div class="modal-body">                        

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="id_producto" class="control-label">
                            Proveedor
                            <span class="text-danger" title="Este campo es obligatorio">*</span>
                        </label>                                
                        <select class="form-control" id="id_producto" name="id_producto" ng-model="id_producto">
                            <option value="">Seleccione:</option> 

                            @foreach($proveedores as $p)
                               <option value="{{$p->id}}" >{{$p->nombre}}</option>
                            @endforeach
                        </select>            


                    </div>                                
                    <!--div class="col-md-6">
                        <label for="producto" class="control-label">
                            Producto
                            <span class="text-danger" title="Este campo es obligatorio">*</span>
                        </label>
                        <select class="form-control" id="producto" name="producto" ng-model="producto">
                            <option value="">Seleccione:</option>                                       
                            @foreach($tarifas as $p)
                               <option value="{{$p->id}}" >{{$p->descripcion}}</option>
                            @endforeach
                        </select>
                    </div-->
                    <div class="col-md-6">
                        <label class="control-label" for="monto">
                            Monto
                            <span class="text-danger" title="Este campo es obligatorio">*</span>
                        </label>
                        <select class="form-control" id="monto" name="monto" ng-model="monto">
                            <option  value="">Seleccione:</option> 
                            @foreach($montos as $monto)
                               <option value="{{$monto->id}}" >{{$monto->descripcion}}</option>
                            @endforeach
                        </select>
                    </div> 
                </div>
                <div class="form-group row">                                
                                                   
                    <div class="col-md-6">
                        <label class="control-label" for="codigo_cliente">
                            Celular
                            <span class="text-danger" title="Este campo es obligatorio">*</span>
                        </label>
                        <input onkeypress ="return isNumberKey(this);"   type="text" class="form-control" id="codigo_cliente" name="codigo_cliente" placeholder="Introduzca número a recargar" ng-model="codigo_cliente">
                        <input type="hidden"  class="form-control" id="id_estado" name="id_estado"  ng-model="id_estado">
                        <input type="hidden" value="1" class="form-control" id="id_tipo_transaccion" name="id_tipo_transaccion"  ng-model="id_tipo_transaccion">
                        <input type="hidden" value="1" class="form-control" id="trx" name="trx"  ng-model="trx">
                        <input type="hidden" value="{{$saldo->acreditado}}" class="form-control" id="acreditado" name="acreditado"  ng-model="acreditado">
                        <input type="hidden" value="{{$saldo->comision}}" class="form-control" id="comision" name="comision"  ng-model="comision">
                        <input type="hidden" value="{{$saldo->saldo}}" class="form-control" id="saldo" name="saldo"  ng-model="saldo">
                         <input type="hidden" value="" class="form-control" id="id_proveedor" name="id_proveedor"  ng-model="id_proveedor">
                    </div>
                </div>                                                          
            </div>  
            
        </form>    
    </div>
    <div class = "panel-footer">
        <div>
            <input class = "btn btn-success" id="btnSave" type= "button" style= "margin-left: 10px;" value= "Recargar" ng-click= "toggle('{{$operation}}')">
        </div>
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
           /* if (evt.value[0] == "0") {
        //  return false;
            // se eliminan los ceros delanteros
            evt.value = evt.value.replace(/^0+/, '');
            }*/
            return true;
        }
    }
   

    $(document).ready(function(){

       
        $('#id_producto').select2('open');
        $.validator.setDefaults( {
            submitHandler: function () {
                alert( "submitted!" );
            }
        });

        $('#id_producto').on('change',function(){       

            if(1 != $("#id_producto").val() ){
                console.log($('#id_producto').val());
                $("#btnSave").attr("ng-click","toggle('{{$operation = other}}')")
                console.log("{{$operation}}");
            }else{
                $("#btnSave").attr("ng-click","toggle('{{$operation = add}}')")
            }
            var proveedores =  "{{$proveedores}}"

                proveedores=proveedores.replace(/&quot;/g,'"');

                 proveedores = JSON.stringify(eval("(" + proveedores + ")"));
                 proveedores= JSON.parse(proveedores);
                 $.each(proveedores, function(id,values){
                        if(values.id == $("#id_producto").val()){
                            $("#id_proveedor").val(values.id_proveedor);
                            console.log(values.id_proveedor+' '+$("#id_proveedor").val());
                        }
                    
                    
                });    
        });

       /* $('#producto').on('change',function(){       

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
            
                $.each(montos, function(id,values){
                    //if(values.id_tarifa == $("#producto").val())
                $("#monto").append('<option value="'+values.id+'">'+values.descripcion+'</option>');
            }); 
           // $("#monto").val("").trigger();                             
       // });*/

    });
        
    $("#id_producto").select2();
    
    $("#monto").select2();
    $("#id_tipo_documento").select2();
    $("#id_tipo").select2();

    var maximo = parseInt("{{$saldo->saldo}}");    

    //INICIO DE VALIDACIÓN
    $( "#form_transaccion" ).validate( {
        rules: {
            id_producto: "required",
            
            monto: {
                required : true,
                max : maximo,
                },
            codigo_cliente:"required",
            

        },
        messages: {
            id_producto: "Seleccione un proveedor",
            
            monto: {
                required:"Introduzca el monto a recargar",
                max: "No tiene saldo suficiente. Solicite Acreditación",
            },
            codigo_cliente:"Ingrese el número de teléfono",
            

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

    app.controller("controllerTransaccion", function ($scope, $http, API_URL)
    {

    //Como inician los campos

    $scope.init = function ()
    {
        $("#volver").attr("href","{{ url('/admin/transacciones?m=69') }}");
        $scope.codigo_cliente = "{{($operation == 'update')?$transaccion->codigo_cliente :''}}";
        $scope.id_producto = "{{($operation == 'update')?$transaccion->id_producto :''}}";
        //$scope.producto = "{{($operation == 'update')?$transaccion->producto :''}}";
        $scope.monto = "{{($operation == 'update')?$transaccion->monto :''}}";
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
       if($("#form_transaccion").valid()){
            switch (operation) {
                case 'add':
                    if($("#id_producto").val() == 1){
                        var numero = $('#codigo_cliente').val();
                        var sb_numero = numero.substring(0, 1);
                            if (sb_numero == "0") {
                                //  return false;

                               
                                numero = numero.substring(1);
                               
                                //return false;
                            // se eliminan los ceros delanteros
                            //evt.value = evt.value.replace(/^0+/, '');
                            }
                            
                            swal({
                                title: "CONFIRMAR "+$("#id_producto option:selected").text(),
                                text: "¿Desea recargar <span style='color:#000000'>$"+$("#monto").val()+"</span> al número <span style='color:#000000'>"+$("#codigo_cliente").val()+"</span>?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-succes",
                                confirmButtonText: "Aceptar",
                                cancelButtonText: "Regresar",
                                closeOnConfirm: true,
                                html: true
                            },
                            function(){
                                $(".modal").modal('show');
                                var monto = $('#monto').val();
                                
                                //var numero = $('#codigo_cliente').val();
                                console.log(numero);
                                console.log($scope.serializeObject($("#form_transaccion")));                
                            $.ajax({
                                type: 'POST',            
                                url: 'http://recargasnaor.kradac.com:8084/DineroServicios/webresources/com.kradac.epin/recargaNaor',
                                xhrFields: {
                                    // The 'xhrFields' property sets additional fields on the XMLHttpRequest.
                                    // This can be used to set the 'withCredentials' property.
                                    // Set the value to 'true' if you'd like to pass cookies to the server.
                                    // If this is enabled, your server must respond with the header
                                    // 'Access-Control-Allow-Credentials: true'.
                                    //withCredentials: true
                                },
                                headers: {

                                    // Set any custom headers here.
                                    // If you set any non-simple headers, your server must include these
                                    // headers in the 'Access-Control-Allow-Headers' response header.
                                   
                                },
                                dataType: 'xml',
                                contentType: 'application/x-www-form-urlencoded',
                                data: {"monto":monto,"numero":numero},
                                success: function (data) {
                                    $(".modal").modal('hide');
                                        var xmldoc = data;
                                        var node = xmldoc.getElementsByTagName('status').item(0);
                                        var nodemessage = xmldoc.getElementsByTagName('systemMessage').item(0);
                                        var message = nodemessage.firstChild.data;
                                        var estatus = node.firstChild.data;
                                        var n = message.indexOf(":");
                                        var trx = message.substring(n+1);
                                        console.log(trx);
                                        console.log(message);
                                         console.log(estatus);
                                        console.log(node);
                                        if (estatus == "SUCCESS") {

                                            $("#id_estado").val("2");
                                            $('#trx').val(trx);

                                            $http({
                                                url    : API_URL + 'recargar',
                                                method : 'POST',
                                                params : $scope.serializeObject($("#form_transaccion")),
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded'
                                                }
                                            }).then(function (response)
                                            {
                                                $(".modal").modal('hide');
                                                if (response.data.response) {
                                                    swal({
                                                        title: "Buen trabajo!",
                                                        text: message,
                                                        type: "success",
                                                        showCancelButton: false,
                                                        confirmButtonClass: "btn-succes",
                                                        confirmButtonText: "OK",
                                                        closeOnConfirm: true
                                                    },
                                                    function(){
                                                        document.location.reload();
                                                        /*$(".modal").modal('show');
                                                        window.location = "{{ url('/admin/empresa?m=3') }}";*/
                                                    });
                                                } else {
                                                    swal("Error", "¡No se guardó!", "error");
                                                }
                                            });
                                        } else {

                                            $("#id_estado").val("3");
                                            $('#trx').val(trx+' - '+message);



                                             
                                             $http({
                                                url    : API_URL + 'recargar',
                                                method : 'POST',
                                                params : $scope.serializeObject($("#form_transaccion")),
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded'
                                                }
                                            }).then(function (response)
                                            {
                                                $(".modal").modal('hide');
                                                if (response.data.response) {
                                                    swal({
                                                        title: "¡Error!",
                                                        text: "¡Imposible realizar la recarga. Intente nuevamente.!",
                                                        type: "error",
                                                        showCancelButton: false,
                                                        confirmButtonClass: "btn-succes",
                                                        confirmButtonText: "OK",
                                                        closeOnConfirm: true
                                                    },
                                                    function(){
                                                        //swal("Error", "¡Imposible realizar la recarga. Intente nuevamente.!", "error");
                                                        /*$(".modal").modal('show');
                                                        window.location = "{{ url('/admin/empresa?m=3') }}";*/
                                                    });
                                                } else {
                                                    swal("Error", "¡No se guardó!", "error");
                                                }
                                            });
                                            
                                        }
                                },
                                error: function(jqXmlHttpRequest, textStatus, errorThrown) { 
                                    swal({
                                        title: "¡Error!",
                                        text: "Problemas al comunicarse con el servicio. Comuniquese con su proveedor",
                                        type: "error",
                                        showCancelButton: false,
                                        confirmButtonClass: "btn-succes",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: true
                                    },
                                    function(){
                                        //swal("Error", "¡Imposible realizar la recarga. Intente nuevamente.!", "error");
                                        /*$(".modal").modal('show');
                                        window.location = "{{ url('/admin/empresa?m=3') }}";*/
                                    });
                                 },
                            });
                            });
                    }else{
                       // alert("hola");
                        $("#id_estado").val("0");
                        $('#trx').val("0");
                        $(".modal").modal('show');
                        var numero = $('#codigo_cliente').val();
                        var sb_numero = numero.substring(0, 1);
                            if (sb_numero != "0") {
                                //  return false;

                                console.log(numero);
                                numero = '0'+numero;
                                console.log(numero);
                                //return false;
                            // se eliminan los ceros delanteros
                            //evt.value = evt.value.replace(/^0+/, '');
                            }
                            $('#codigo_cliente').val(numero);
                            console.log($('#codigo_cliente').val());
                            //return false;
                       // console.log($scope.serializeObject($("#form_laboratorio")));
                       swal({
                                title: "CONFIRMAR "+$("#id_producto option:selected").text(),
                                text: "¿Desea recargar <span style='color:#000000'>$"+$("#monto").val()+"</span> al número <span style='color:#000000'>"+$("#codigo_cliente").val()+"</span>?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-succes",
                                confirmButtonText: "Aceptar",
                                cancelButtonText: "Regresar",
                                closeOnConfirm: true,
                                html: true
                            },
                            function(){

                                $http({
                                    url    : API_URL + 'recargar',
                                    method : 'POST',
                                    params : $scope.serializeObject($("#form_transaccion")),
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    }
                                }).then(function (response)
                                {
                                    $(".modal").modal('hide');
                                    if (response.data.response) {
                                        swal({
                                            title: response.data.titulo,
                                            text: response.data.mensaje,
                                            type: response.data.type,
                                            showCancelButton: false,
                                            confirmButtonClass: response.data.button,
                                            confirmButtonText: response.data.buttonText,
                                            closeOnConfirm: false,
                                            showLoaderOnConfirm: true,
                                            html: true
                                        },
                                        function(){
                                            document.location.reload();
                                            /*$(".modal").modal('show');
                                            window.location = "{{ url('/admin/empresa?m=3') }}";*/
                                        });
                                    } else {
                                        swal("Error", "¡Comuniquese con el proveedor del servicio!", "error");
                                    }
                                });
                            }
                        );
                    }                                                
                break;
            }
        }
    }
});

 
        
</script>

@endsection