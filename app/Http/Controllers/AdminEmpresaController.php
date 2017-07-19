<?php namespace App\Http\Controllers;

	use Session;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use crocodicstudio\crudbooster\helpers\CRUDBooster;
	use Illuminate\Support\Facades\DB;
	use App\ModEmpresa;
	use App\ModComision;

	class AdminEmpresaController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function __construct() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
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
			$this->table = "empresa";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nombre","name"=>"nombre"];
			$this->col[] = ["label"=>"Empresa Padre","name"=>"id_empresa","join"=>"empresa,nombre"];
			$this->col[] = ["label"=>"Tipo","name"=>"id_tipo","join"=>"tipo,tipo"];
			$this->col[] = ["label"=>"Estado","name"=>"id_estado_empresa","join"=>"estado_empresa,estado"];
			$this->col[] = ["label"=>"Tipo Documento","name"=>"id_tipo_documento","join"=>"tipo_documento,tipo"];
			$this->col[] = ["label"=>"Codigo Documento","name"=>"codigo_documento"];
			$this->col[] = ["label"=>"Telefono","name"=>"telefono"];
			$this->col[] = ["label"=>"Telefono Celular","name"=>"telefono_celular"];
			$this->col[] = ["label"=>"Provincia","name"=>"provincia","join"=>"provincia,descripcion"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ["label"=>"Nombre","name"=>"nombre","type"=>"text","validation"=>"required|string|min:5|max:5000","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Empresa Padre","name"=>"id_empresa","type"=>"select2","validation"=>"required|integer|min:0","width"=>"col-sm-10","datatable"=>"empresa,nombre"];
			$this->form[] = ["label"=>"Tipo","name"=>"id_tipo","type"=>"select","validation"=>"required","width"=>"col-sm-10","datatable"=>"tipo,tipo"];
			$this->form[] = ["label"=>"Estado","name"=>"id_estado_empresa","type"=>"select","validation"=>"required","width"=>"col-sm-10","datatable"=>"estado_empresa,estado"];
			$this->form[] = ["label"=>"Tipo Documento","name"=>"id_tipo_documento","type"=>"select","validation"=>"required","width"=>"col-sm-9","datatable"=>"tipo_documento,tipo"];
			$this->form[] = ["label"=>"Codigo Documento","name"=>"codigo_documento","type"=>"text","validation"=>"required","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Razon Social","name"=>"razon_social","type"=>"textarea","validation"=>"required","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Direccion Principal","name"=>"direccion_principal","type"=>"textarea","validation"=>"required","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Telefono","name"=>"telefono","type"=>"text","validation"=>"required|string|min:7|max:9","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Telefono Celular","name"=>"telefono_celular","type"=>"text","validation"=>"required|string|min:10|max:10","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Pais","name"=>"pais","type"=>"text","validation"=>"required","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Provincia","name"=>"provincia","type"=>"text","validation"=>"required","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Region","name"=>"region","type"=>"text","validation"=>"required","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Ciudad","name"=>"ciudad","type"=>"text","validation"=>"required","width"=>"col-sm-9"];
			# END FORM DO NOT REMOVE THIS LINE

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = '$(function() {
			//alert("hola");
			var tipo = $("#id_tipo");
			//tipo.val("2");

			
		});
		';



	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();



	        //No need chanage this constructor
	        $this->constructor();
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
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
				$query->whereIn('empresa.id',$id_empresas)->where('empresa.id','<>',''.$miempresa.'')->get();
		           
		    }
		}

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :)
		public function getAdd(){
			$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    		$miempresa = CRUDBooster::get('empresa','id = '.$usuario->id_empresa.' ')->first(); 
    		//dd($miempresa);
    		if($miempresa->id_tipo == 4){
    			$tipo_empresa = DB::table('tipo')->select('*')->whereIn('id',array(2,3))->get();
    			//dd($tipo_empresa);
    		}else{
    			$tipo_empresa = DB::table('tipo')->select('*')->where('id','3')->get();
    		}

			$tipo_documento = DB::table('tipo_documento')->select('*')->get();
			
			$estado_empresa = DB::table('estado_empresa')->select('*')->get();
			$regiones = DB::table('region')->select('id','descripcion')->get();
			$productos = DB::table('producto')->select('*')->get();
			//$ciudades = DB::table('ciudad')->select('id','id_provincia','descripcion')->get();
			//dd($provincia);
			$operation = 'add';
			$page_title = 'Empresa';
			return view("empresa.index",compact('page_title',
												 'operation',
												 'tipo_documento',
												 'tipo_empresa',
												 'estado_empresa',
												 'regiones',
												 'provincias',
												 'productos')); 
			
		}

		 
		public function getEdit($id)
		{
			$tipo_documento = DB::table('tipo_documento')->select('*')->get();
			$tipo_empresa = DB::table('tipo')->select('*')->get();
			$estado_empresa = DB::table('estado_empresa')->select('*')->get();
			$regiones = DB::table('region')->select('id','descripcion')->get();
			$operation = 'update';
			$page_title = 'Empresa';
			$empresa = ModEmpresa::findOrFail($id); 
			$productos = DB::table('producto')->select('*')->get();
			$provincias = DB::table('provincia')->select('id','descripcion')->where(['id_region' => $empresa->region])->get();
			$productos_activos = DB::table('comision')->select('*')->where('id_empresa',$empresa->id)->get();
			//dd($productos_activos);
			return view("empresa.index",compact('empresa',
												'page_title',
												'operation',
												'tipo_documento',
												'tipo_empresa',
												'estado_empresa',
												'regiones',
												'provincias',
												'productos',
												'productos_activos')); 
		}
		 
		public function store(Request $request)
		{
			$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    		$miempresa = $usuario->id_empresa;
    		$productos = DB::table('producto')->select('*')->get();
    		//dd($productos);

    		
			$empresa =  new ModEmpresa;
			$empresa->id_empresa = $miempresa;
			$empresa->nombre = $request->get('nombre');
			$empresa->razon_social = $request->get('razon_social');
			$empresa->codigo_documento = $request->get('codigo_documento');
			$empresa->telefono = $request->get('telefono');
			$empresa->telefono_celular = $request->get('telefono_celular');
			$empresa->direccion_principal = $request->get('direccion_principal');
			$empresa->id_tipo_documento = $request->get('id_tipo_documento');
			$empresa->id_tipo = $request->get('id_tipo');
			$empresa->id_estado_empresa = $request->get('id_estado_empresa');
			$empresa->region = $request->get('region');
			$empresa->provincia = $request->get('provincia');
			//$empresa->ciudad = $request->get('ciudad');

			$response = $empresa->save();

			foreach ($productos as $producto) {
    			$product_active = $request->input($producto->id);
				$product_active = array_filter($product_active);
				$product_active['porcentaje'] = $product_active['porcentaje'] < 0?'0':$product_active['porcentaje'];
				if($product_active['estatus']){
					$comision =  new ModComision;
					$comision->id_empresa  = $empresa->id;
					$comision->id_producto   = $producto->id;
					$comision->porcentaje  = $product_active['porcentaje'];
					$comision->estatus   = $product_active['estatus'];
					$comision->save();
					/*
					DB::table('comision')->insert(
					    ['id_empresa' => $empresa->id, 'id_producto' => $producto->id,'porcentaje' =>$product_active['porcentaje']]
					);
					*/
				}
				//dd($product_active['porcentaje']);
    			
    		}

			return response()->json([
				"response" => $response,
				"empresa" =>$empresa]);
		}

		public function update(Request $request, $id)
		{
		 	$empresa = ModEmpresa::findOrFail($id); 
			$empresa->nombre = $request->get('nombre');
			$empresa->razon_social = $request->get('razon_social');
			$empresa->codigo_documento = $request->get('codigo_documento');
			$empresa->telefono = $request->get('telefono');
			$empresa->telefono_celular = $request->get('telefono_celular');
			$empresa->direccion_principal = $request->get('direccion_principal');
			$empresa->id_tipo_documento = $request->get('id_tipo_documento');
			$empresa->id_tipo = $request->get('id_tipo');
			$empresa->id_estado_empresa = $request->get('id_estado_empresa');
			$empresa->region = $request->get('region');
			$empresa->provincia = $request->get('provincia');
			//$empresa->ciudad = $request->get('ciudad');
			//$delete= DB::table('comision')->where('id_empresa',$id)->delete();
			$productos = DB::table('producto')->select('*')->get();

			foreach ($productos as $producto ) {
    			$product_active = $request->input($producto->id);
				$product_active = array_filter($product_active);
				$product_active['porcentaje'] = $product_active['porcentaje'] < 0?0:$product_active['porcentaje'];
				//if($product_active['estatus'] || $product_active['porcentaje'] >0){
				//$product_active['estatus'] = $product_active['estatus'] == 'on'?$product_active['estatus'] :'off';

					$comision = ModComision::updateOrCreate(array('id_producto' => $producto->id,'id_empresa' => $empresa->id),
						array('id_producto' => $producto->id,'id_empresa' => $empresa->id,'porcentaje' => $product_active['porcentaje'],'estatus' => $product_active['estatus'] ));
					/*
					DB::table('comision')->insert(
					    ['id_empresa' => $empresa->id, 'id_producto' => $producto->id,'porcentaje' =>$product_active['porcentaje']]
					);
					*/
				//}
				//dd($product_active['porcentaje']);
    			
    		}

			$response = $empresa->save();
			return response()->json([
				"response" => $response,
				"empresa" =>$empresa]);
		}

		public function provincias($id){
			$provincias = DB::table('provincia')->select('id','descripcion')->where(['id_region' => $id])->get();
			return response()->json(["provincias"=>$provincias]);

		}
	}