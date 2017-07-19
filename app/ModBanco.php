<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModBanco extends Model
{
    protected $table='banco'; 
	protected $primaryKey='id';
	protected $fillable=[
		'id_empresa',
		'cuenta_deposito',
		'nombre_banco',
		'tipo_cuenta',
		'titular'
 	];
	 protected $guarded=[]; 
}
