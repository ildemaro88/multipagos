<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModUsuario extends Model
{
    protected $table='cms_users'; 
	protected $primaryKey='id';
	protected $fillable=[
		'name',
		'email',
		'password',
		'telefono_user',
		'direccion_user',
		'photo',
		'id_cms_privileges',
		'id_empresa'
 	];
	 protected $guarded=[]; 
}
