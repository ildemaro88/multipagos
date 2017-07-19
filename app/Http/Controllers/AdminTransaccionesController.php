<?php namespace App\Http\Controllers;

	use Session;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use crocodicstudio\crudbooster\helpers\CRUDBooster;
	use Illuminate\Support\Facades\DB;
	use Carbon\Carbon;
	

	class AdminTransaccionesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function __construct() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "transacciones";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Empresa","name"=>"empresa"];
			$this->col[] = ["label"=>"Descripcion","name"=>"descripcion"];
			$this->col[] = ["label"=>"Referencia","name"=>"referencia"];
			$this->col[] = ["label"=>"Estado","name"=>"estado"];
			$this->col[] = ["label"=>"Monto","name"=>"monto"];
			$this->col[] = ["label"=>"Fecha","name"=>"fecha"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ["label"=>"Empresa","name"=>"id_empresa","type"=>"select2","validation"=>"required|min:3|max:255","width"=>"col-sm-10","datatable"=>"empresa,id"];
			$this->form[] = ["label"=>"Empresa","name"=>"empresa","type"=>"text","validation"=>"required|min:3|max:255","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Descripcion","name"=>"descripcion","type"=>"text","validation"=>"required|min:3|max:255","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Referencia","name"=>"referencia","type"=>"number","validation"=>"required|integer|min:0","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Estado","name"=>"estado","type"=>"text","validation"=>"required|min:3|max:255","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Monto","name"=>"monto","type"=>"text","validation"=>"required|min:3|max:255","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Fecha","name"=>"fecha","type"=>"datetime","validation"=>"required|date_format:Y-m-d H:i:s","width"=>"col-sm-10"];
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
	         $this->addaction =array(['label'=>'Aprobar','icon'=>'fa fa-money','color'=>'success aprobar','url'=>'[id]',"showIf"=>"[estado] == 'SOLICITUD EN ESPERA'"],['label'=>'Denegar','icon'=>'fa fa-money','color'=>'danger denegar','url'=>'[id]',"showIf"=>"[estado] == 'SOLICITUD EN ESPERA'"]);


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
			// corregir error de doble calendario
			//alert("hola");
			$(".print").attr("target","_blank");

			$(".aprobar").click(function(e){
				e.preventDefault();
				var $this = $(this);
				var id = $this.attr("href");
				swal({
					title: "¿Desea aprobar está acreditación?",
					text: "Valide bien, antes de aprobar",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#dd6b55",
					confirmButtonText: "OK",
					closeOnConfirm: false,
					showLoaderOnConfirm: true
				},
				function(){

					var url1 ="admin/transacciones_aprobar/solicitud/aprobada/"+id;
					$this.attr("href",url1);
					$.ajax({
						url: "transacciones_aprobar/solicitud/aprobada/"+id,
						type: "GET",
						success: function(){
							swal({
								title: "¡Exito!", text: "Solicitud Aprobada exitosamente", type: "success"
								},
								function(){document.location.reload();

								}
							);
						},
					});
				});
			});

			$(".denegar").click(function(e){
				e.preventDefault();
				var $this = $(this);
				var id = $this.attr("href");
				swal({
					title: "¿Desea denegar está solicitud?",
					text: "Está acción es irreversible",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#dd6b55",
					confirmButtonText: "OK",
					closeOnConfirm: false,
					showLoaderOnConfirm: true
				},
				function(){
					var url1 ="admin/transacciones_aprobar/solicitud/aprobada/"+id;
					$this.attr("href",url1);
					$.ajax({
						url: "transacciones_aprobar/solicitud/denegada/"+id,
						type: "GET",
						success: function(){
							document.location.reload();
						},
					});
				});
			});
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
		       /* $subdistribuidores = CRUDBooster::get('empresa','id='.$miempresa.' or id_empresa ='.$miempresa.'');
		        $total = count($subdistribuidores);
		        foreach ($subdistribuidores as $key =>$empresa) {
		        	if($key == $total-1){
		        		$id_empresas .= $empresa->id;
		        	}else{
		        		$id_empresas .= $empresa->id.',';
		        	}
		        }*/
		        //dd($id_empresas);
		        //$id_empresas_array = explode(',',  $id_empresas);

		        $comercios = CRUDBooster::get('empresa','id_empresa in ('.$miempresa.')');
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
				$query->whereIn('id_empresa',$id_empresas)->where('id_tipo_transaccion','2')->where('id_estado','1')->get();
		           
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



	   public function aprobarAcreditacion($id){
	   	//dd($id);  
	   	$transaccion=CRUDBooster::get('transaccion','id = '.$id.' ')->first();  		
    	
    	$comision = CRUDBooster::get('empresa','id = '.$transaccion->id_empresa.' ')->first();  	
	   	$acreditado =	DB::table('empresa')
            ->where('id', $transaccion->id_empresa)
            ->update(['acreditado' => 'acreditado'+$transaccion->monto]);

        $saldo = $comision->comision + $transaccion->monto;
            $saldo =	DB::table('empresa')
             ->where('id', $transaccion->id_empresa)
            ->update(['saldo' => 'saldo'+$saldo]);

	   	$response =	DB::table('transaccion')
            ->where('id', $id)
            ->update(['id_estado' => 4]);
        return $true;

	   }

	   public function denegarAcreditacion($id){
	    $response =	DB::table('transaccion')
            ->where('id', $id)
            ->update(['id_estado' => 5]);
         return $true;

	   }



	}