<?php namespace App\Http\Controllers;

use Session;
use Request as re;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Support\Facades\DB;
use App\ModUsuario;

class AdminCmsUsersController extends \crocodicstudio\crudbooster\controllers\CBController {

	public function __construct() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "name,dec";
			$this->global_privilege = true;
			$this->button_table_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = true;
			$this->button_export = true;
			$this->table = "cms_users";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Photo","name"=>"photo","image"=>true];
			$this->col[] = ["label"=>"Empresa","name"=>"id_empresa","join"=>"empresa,nombre"];
			$this->col[] = ["label"=>"Telefono","name"=>"telefono_user"];
			$this->col[] = ["label"=>"Direccion","name"=>"direccion_user"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ["label"=>"Name","name"=>"name","type"=>"text","validation"=>"required|alpha_spaces|min:3","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Email","name"=>"email","type"=>"email","validation"=>"required|email","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Photo","name"=>"photo","type"=>"upload","validation"=>"required|image|max:1000","width"=>"col-sm-10","help"=>"Recommended resolution is 200x200px"];
			$this->form[] = ["label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","validation"=>"","width"=>"col-sm-10","datatable"=>"cms_privileges,name"];
			$this->form[] = ["label"=>"Password","name"=>"password","type"=>"password","validation"=>"","width"=>"col-sm-10","help"=>"Please leave empty if not change"];
			$this->form[] = ["label"=>"Telefono","name"=>"telefono_user","type"=>"text","validation"=>"required|string|min:6|max:15","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Direccion","name"=>"direccion_user","type"=>"text","validation"=>"required","width"=>"col-sm-9"];
			# END FORM DO NOT REMOVE THIS LINE

			if(CRUDBooster::getCurrentMethod() == 'getProfile') {
			$this->button_addmore = false;
			$this->button_cancel  = false;
			$this->button_show    = false;			
			$this->button_add     = false;
			$this->button_delete  = false;	
			$this->hide_form      = ['id_cms_privileges'];		
		}		
		
		$this->constructor();
	}
	
    /*
    | ---------------------------------------------------------------------- 
    | Hook for manipulate query of index result 
    | ---------------------------------------------------------------------- 
    | @query = current sql query 
    |
    */
    public function hook_query_index(&$query) {
    	$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    	$miempresa = $usuario->id_empresa;



    	if($miempresa > 0){
	        $subdistribuidores = CRUDBooster::get('empresa','id='.$miempresa.' or id_empresa ='.$miempresa.'');
	        $total = count($subdistribuidores);
	        foreach ($subdistribuidores as $key =>$empresa) {
	        	if($key == $total-1){
	        		$id_empresas .= $empresa->id;
	        	}else{
	        		$id_empresas .= $empresa->id.',';
	        	}
	        }
	        //dd($id_empresas);
	        //$id_empresas_array = explode(',',  $id_empresas);

	        $comercios = CRUDBooster::get('empresa','id_empresa in ('.$id_empresas.')');
	        $total = count($comercios);
	        foreach ($comercios as $key =>$comercio) {
	        	if($key == $total-1){
	        		$id_empresas .= ','.$comercio->id;
	        	}else{
	        		$id_empresas .= ','.$comercio->id;
	        	}
	        }
	       // dd($id_empresas);

	        $id_empresas = explode(',',  $id_empresas);
			$query->whereIn('cms_users.id_empresa',$id_empresas)->where('cms_users.id','<>',''.$usuario->id.'')->get();
		}else{
			$query->where('cms_users.id','<>',''.$usuario->id.'')->get();
		}

            
    }

	public function getProfile() {				
		$data['page_title'] = trans("crudbooster.label_button_profile");
		$data['row']        = DB::table($this->table)->where($this->primary_key,CRUDBooster::myId())->first();
		$data['return_url'] = re::fullUrl();
		return view('crudbooster::default.form',$data);
	}

	public function getAdd(){
		$user=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    	$miempresa = $user->id_empresa;
    	$empresas = DB::table('empresa')->select('*')->where('id_empresa',$miempresa)->get();
    	//dd($empresas);
		//$privilegios = DB::table('cms_privileges')->select('*')->where('is_superadmin',0)->get();
		//$tipo_empresa = DB::table('tipo')->select('*')->where('is_superadmin',0)->get();
		//$estado_empresa = DB::table('estado_empresa')->select('*')->get();
		//$regiones = DB::table('region')->select('id','descripcion')->get();
		$operation = 'add';
		$page_title = 'Crear Usuario';
		//dd($usuario);
		//$provincias = DB::table('provincia')->select('id','descripcion')->where(['id_region' => $empresa->region])->get();
		
		return view("usuario.index",compact('page_title',
											'operation',											
											'empresas'
											)); 
			
		}

		 
	public function getEdit($id)
	{
		$user=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    	$miempresa = $user->id_empresa;
    	$empresas = DB::table('empresa')->select('*')->where('id_empresa',$miempresa)->get();
    	//dd($empresas);
		$privilegios = DB::table('cms_privileges')->select('*')->where('is_superadmin',0)->get();
		//$tipo_empresa = DB::table('tipo')->select('*')->where('is_superadmin',0)->get();
		//$estado_empresa = DB::table('estado_empresa')->select('*')->get();
		//$regiones = DB::table('region')->select('id','descripcion')->get();
		$operation = 'update';
		$page_title = 'Editar Usuario';
		$usuario = ModUsuario::findOrFail($id); 
		//dd($usuario);
		//$provincias = DB::table('provincia')->select('id','descripcion')->where(['id_region' => $empresa->region])->get();
		
		return view("usuario.index",compact('usuario',
											'page_title',
											'operation',
											'tipo_documento',
											'tipo_empresa',
											'privilegios',
											'empresas',
											'regiones',
											'provincias')); 
	}
	
	public function store(Request $request)
	{
		$usuario =  new ModUsuario;
		$usuario->name = $request->get('name');
		$usuario->email = $request->get('email');
		$usuario->password = bcrypt($request->get('password'));
		$usuario->telefono_user = $request->get('telefono_user');
		$usuario->direccion_user = $request->get('direccion_user');
		//$usuario->photo = $request->get('photo');		
		$usuario->id_empresa = $request->get('id_empresa');
		$empresa = DB::table('empresa')->select('*')->where('id',$request->get('id_empresa'))->first();
		//dd($empresa);
		if($empresa->id_tipo == 2){
			$usuario->id_cms_privileges = 3;
		}else{
			$usuario->id_cms_privileges = 4;
		}
		$response = $usuario->save();
		return response()->json([
			"response" => $response,
			"usuario" =>$usuario]);
	} 
	

	public function update(Request $request, $id)
	{
		$usuario =  ModUsuario::findOrFail($id);
		$usuario->name = $request->get('name');
		$usuario->email = $request->get('email');
		$usuario->password = bcrypt($request->get('password'));
		$usuario->telefono_user = $request->get('telefono_user');
		$usuario->direccion_user = $request->get('direccion_user');
		//$usuario->photo = $request->get('photo');		
		$usuario->id_empresa = $request->get('id_empresa');
		$empresa = DB::table('empresa')->select('*')->where('id',$request->get('id_empresa'))->get();

		if($empresa->id_tipo == 2){
			$usuario->id_cms_privileges = 3;
		}else{
			$usuario->id_cms_privileges = 4;
		}
		$response = $usuario->save();
		return response()->json([
			"response" => $response,
			"usuario" =>$usuario]);
	 	
	}

	public function provincias($id){
		$provincias = DB::table('provincia')->select('id','descripcion')->where(['id_region' => $id])->get();
		return response()->json(["provincias"=>$provincias]);

	}
}