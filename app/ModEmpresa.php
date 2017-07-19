<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModEmpresa extends Model
{
    protected $table='empresa'; 
	protected $primaryKey='id';
	protected $fillable=[
		'id_empresa',
		'nombre',
		'razon_social',
		'codigo_documento',
		'telefono',
		'telefono_celular',
		'direccion_principal',
		'id_tipo_documento',
		'id_tipo',
		'id_estado_empresa',
		'region',
		'provincia'
 	];
	 protected $guarded=[]; 
}
