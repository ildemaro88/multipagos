<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModComision extends Model
{
    protected $table='comision'; 
	protected $primaryKey='id';
	protected $fillable=[
		'id_empresa',
		'id_producto',
		'porcentaje',
		'estatus'
 	];
	 protected $guarded=[]; 
}
