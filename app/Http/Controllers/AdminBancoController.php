<?php namespace App\Http\Controllers;


    use Illuminate\Support\Facades\Auth;
   	use Session;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use crocodicstudio\crudbooster\helpers\CRUDBooster;
	use Illuminate\Support\Facades\DB;
	use App\ModBanco;


	class AdminBancoController extends \crocodicstudio\crudbooster\controllers\CBController {




        public function __construct() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "banco";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nombre Banco","name"=>"nombre_banco"];
			$this->col[] = ["label"=>"Cuenta Deposito","name"=>"cuenta_deposito"];
			$this->col[] = ["label"=>"Tipo de Cuenta","name"=>"tipo_cuenta"];
			$this->col[] = ["label"=>"Titular","name"=>"titular"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ["label"=>"Nombre Banco","name"=>"nombre_banco","type"=>"text","validation"=>"required|min:3|max:255","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Cuenta Deposito","name"=>"cuenta_deposito","type"=>"text","validation"=>"required|string|min:0","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Tipo Cuenta","name"=>"tipo_cuenta","type"=>"text","validation"=>"required","width"=>"col-sm-9"];
			$this->form[] = ["label"=>"Titular","name"=>"titular","type"=>"","validation"=>"required","width"=>"col-sm-9"];
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
	        $this->script_js = NULL;



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
    		$empresa = CRUDBooster::get('empresa','id = '.$miempresa.' ')->first(); 
    		$tipo_empresa = $empresa->id_tipo;
    		$padre = $empresa->id_empresa;

    		if($tipo_empresa < 4){
    			$query->where('id_empresa',$padre)->get();
    		}else{
    			$query->where('id_empresa',$miempresa)->get();
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





	    public function getAdd()
		{
			$operation = 'add';
			$page_title = 'Banco';
			return view("banco.index",compact('page_title', 'operation')); 
		}
		public function getEdit($id)
		{
			$operation = 'update';
			$page_title = 'Banco';
			$banco = ModBanco::findOrFail($id); 
			return view("banco.index", compact('page_title', 'operation','banco')); 
		}

		public function store(Request $request)
		{
			$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    		$miempresa = $usuario->id_empresa;
			$banco =  new ModBanco;
			$banco->cuenta_deposito = $request->get('cuenta_deposito');
			$banco->nombre_banco = $request->get('nombre_banco');
			$banco->tipo_cuenta = $request->get('tipo_cuenta');
			$banco->id_empresa = $miempresa;
			$banco->titular = $request->get('titular');

			$response = $banco->save();
			return response()->json([
				"response" => $response,
				"banco" =>$banco]);
		}

		public function update(Request $request, $id)
		{
		 	$banco = ModBanco::findOrFail($id); 
			$banco->cuenta_deposito = $request->get('cuenta_deposito');
			$banco->nombre_banco = $request->get('nombre_banco');
			$banco->tipo_cuenta = $request->get('tipo_cuenta');
			$banco->titular = $request->get('titular');
			$response = $banco->save();
			return response()->json([
				"response" => $response,
				"banco" =>$banco]);
		}

	}