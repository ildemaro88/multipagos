<?php

namespace App\Http\Controllers;

use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDatosUsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUser = CRUDBooster::myId();

        $nombreUsuario = CRUDBooster::myName();

        $idEmpresaUsuario = DB::table('cms_users')->where('id', $idUser)->pluck('id_empresa');
        $path = url('/');
        $foto = DB::table('cms_users')->where('id', $idUser)->pluck('photo');
        $foto = str_replace("\\", "", $foto);
        $foto = str_replace("\"]", "", $foto);
        $foto = str_replace("[\"", "", $foto);
        $foto = $path.'\\'.$foto;
        $nombreEmpresaUsuario = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('nombre')[0];

        $correo=DB::table('cms_users')->where('id',$idUser)->pluck('email')[0];

        $telefono_user= DB::table('cms_users')->where('id',$idUser)->pluck('telefono_user')[0];

        $direccion_user= DB::table('cms_users')->where('id',$idUser)->pluck('direccion_user')[0];

        $razon_social =  DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('razon_social')[0];

        $id_tipo_documento = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('id_tipo_documento')[0];

        $tipo_documento = DB::table('tipo_documento')->where('id', $id_tipo_documento)->pluck('tipo')[0];

        $codigo_documento = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('codigo_documento')[0];

        $representante_legal = CRUDBooster::myName();

        $direccion_principal = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('direccion_principal')[0];

        $telefono = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('telefono')[0];

        $telefono_celular = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('telefono_celular')[0];

        $pais = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('pais')[0];

        $provincia = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('provincia')[0];

        $region = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('region')[0];

        $ciudad = DB::table('empresa')->where('id', $idEmpresaUsuario)->pluck('ciudad')[0];



        return view('miusuario', compact('nombreUsuario', 'nombreEmpresaUsuario', 'correo', 'telefono_user' , 'direccion_user','razon_social','tipo_documento','codigo_documento','representante_legal','direccion_principal','telefono','telefono_celular','pais','provincia','region','ciudad','foto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
