@extends("crudbooster::admin_template")
@section("content")


    <div class="row">
        <div class="col-md-">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false">Datos de Usuario</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Datos de Empresa</a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <!-- Contenido Tab 1 -->
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-12">
                                <!-- Widget: user widget style 1 -->
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua-active">
                                        <h3 class="widget-user-username">{{$nombreUsuario }}</h3>
                                        <h5 class="widget-user-desc">{{$nombreEmpresaUsuario}}</h5>
                                        <a href="{{CRUDBooster::adminPath($slug='')}}/users/profile?m=0" class="btn btn-default btn-flat"><i class="fa fa-cog"></i> Configurar</a>
                                    </div>
                                    <div class="widget-user-image">
                                  
                                        <img class="img-circle" src="{{$foto}}?w=80."' alt="User Avatar">
                                    </div>
                                    <div class="box-footer" style="margin-top: 20px;">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">CORREO</h5>
                                                    <span class="description-text">{{$correo}}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">TELEFONO</h5>
                                                    <span class="description-text">{{$telefono_user}}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4" style="word-wrap: break-word;">
                                                <div class="description-block">
                                                    <h5 class="description-header">DIRECCIÓN</h5>
                                                    <span class="description-text">{{$direccion_user}}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- Fin Contenido Tab 1 -->
                    </div>
                    <!-- /.tab-pane -->

                    <!-- Contenido Tab 1 -->
                    <div class="tab-pane" id="tab_2">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="{{url('/')}}/vendor/crudbooster/photos/empresa_logo.png" alt="User profile picture">

                                <h3 class="profile-username text-center">{{$nombreEmpresaUsuario}}</h3>

                                <p class="text-muted text-center">{{$razon_social}}</p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Tipo de Documento</b> <a class="pull-right">{{$tipo_documento}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Documento</b> <a class="pull-right">{{$codigo_documento}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Represetante Legal</b> <a class="pull-right">{{$representante_legal}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Telefono</b> <a class="pull-right">{{$telefono}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Teléfono Celular</b> <a class="pull-right">{{$telefono_celular}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Dirección Principal</b> <a class="pull-right">{{$rdireccion_principal}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>País</b> <a class="pull-right">{{$pais}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Provincia</b> <a class="pull-right">{{$provincia}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Region</b> <a class="pull-right">{{$region}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Ciudad</b> <a class="pull-right">{{$ciudad}}</a>
                                    </li>

                                </ul>


                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

    </div>


@endsection