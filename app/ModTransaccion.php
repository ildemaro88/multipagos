<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModTransaccion extends Model
{
    protected $table='transaccion'; 
	protected $primaryKey='id';
	protected $fillable=[
		'codigo_cliente',
		'id_empresa',
		'id_tipo_transaccion',
		'id_estado',
		'id_producto',
		'monto',
		'trx'
 	];
	 protected $guarded=[]; 
}
