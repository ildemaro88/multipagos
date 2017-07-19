<?php namespace App\Http\Controllers;
	use Soapclient;
	use Session;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use crocodicstudio\crudbooster\helpers\CRUDBooster;
	use Illuminate\Support\Facades\DB;
	use App\Facades\SoapController as SoapCliente;
	use App\ModTransaccion;
	use Carbon\Carbon;

	class AdminTransaccionController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function __construct() {
	    	//$this->middleware('cors');

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
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "transacciones";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Descripcion","name"=>"descripcion"];
			$this->col[] = ["label"=>"Producto","name"=>"nombre"];
			$this->col[] = ["label"=>"Estado","name"=>"estado"];
			$this->col[] = ["label"=>"Referencia","name"=>"referencia"];
			$this->col[] = ["label"=>"Monto","name"=>"monto"];
			$this->col[] = ["label"=>"Fecha","name"=>"fecha"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ["label"=>"Descripcion","name"=>"descripcion","type"=>"text","validation"=>"required|integer|min:0","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Referencia","name"=>"referencia","type"=>"text","validation"=>"required|min:3|max:255","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Estado","name"=>"estado","type"=>"text","validation"=>"required|integer|min:0","width"=>"col-sm-10"];
			$this->form[] = ["label"=>"Monto","name"=>"monto","type"=>"number","validation"=>"required|integer|min:0","width"=>"col-sm-10"];
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
				$query->whereIn('id_empresa',$id_empresas)->get();
		           
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
    		$miempresa = $usuario->id_empresa;

			$saldo = self::consultarSaldo($miempresa);
			//dd($saldo);
			//$saldo = $saldo->total;
			$proveedores = DB::table('productos')->select('*')->where('id_empresa',$miempresa)->get();
			//dd($proveedores);
			$tarifas = DB::table('tarifa')->select('id','descripcion')->get();
			$montos = DB::table('monto')->select('id','id_tarifa','descripcion')->get();
			$operation = 'add';
			$page_title = 'Recarga';

			return view("transaccion.index",compact('page_title','operation','tarifas','montos','proveedores','saldo'));
		}

		public function getEdit($id)
		{
			$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    		$miempresa = $usuario->id_empresa;

			$saldo = self::consultarSaldo($miempresa);
			//$saldo = $saldo->total;
			$proveedores = DB::table('producto')->select('id','proveedor')->get();
			$tarifas = DB::table('tarifa')->select('id','descripcion')->get();
			$montos = DB::table('monto')->select('id','id_tarifa','descripcion')->get();
			$operation = 'update';
			$page_title = 'Recarga';

			return view("transaccion.index",compact('page_title','operation','tarifas','montos','proveedores','saldo'));
		}

		public function acreditacion(){
			$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    				
			$miempresa = $usuario->id_empresa;
			$padre=CRUDBooster::get('empresa','id = '.$miempresa .' ')->first(); 
			$bancos = CRUDBooster::get('banco','id_empresa = '.$padre->id_empresa .' ');
			$tarifas = DB::table('tarifa')->select('id','descripcion')->get();
			$montos = DB::table('monto')->select('id','id_tarifa','descripcion')->get();
			$icon = "fa fa-hand-o-up";
			$operation = 'add';
			$page_title = 'Solicitar Acreditación';

			return view("transaccion.acreditacion",compact('page_title','operation','tarifas','montos','bancos','icon'));
		}
		

		public function storeRecarga(Request $request)
		{

    		$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    
    		$miempresa = $usuario->id_empresa;
			$transaccion =  new ModTransaccion;
			$transaccion->id_empresa = $miempresa;
			$transaccion->trx = $request->get('trx');
			$transaccion->codigo_cliente = $request->get('codigo_cliente');
			$transaccion->id_producto = $request->get('id_producto');
			$transaccion->id_estado = $request->get('id_estado');
			$transaccion->monto = -$request->get('monto');
			$transaccion->id_tipo_transaccion = $request->get('id_tipo_transaccion');



			$response = $transaccion->save();
			
			if($request->get('id_proveedor') == '05'){


				if($request->get('id_estado') == 2){
					$producto = DB::table('productos')->select('*')->where('id',$request->get('id_producto'))->where('id_empresa',$miempresa)->first();
					$comision = ($request->get('monto') * $producto->porcentaje)/100;
					
					$transaccion =  new ModTransaccion;
					$transaccion->id_empresa = $miempresa;
					$transaccion->trx = $request->get('trx');
					$transaccion->codigo_cliente = $request->get('codigo_cliente');
					$transaccion->id_producto = $request->get('id_producto');
					$transaccion->id_estado = $request->get('id_estado');

					
					$transaccion->monto = $comision;
					$transaccion->id_tipo_transaccion = 3;
					$transaccion->save();
					//$aresta = 
					$monto_r = $request->get('acreditado') - $request->get('monto');

					//INICIO Actualización de saldos-------v>>>>
					if($request->get('acreditado') > 0 && $monto_r >= 0){
						$acreditado = $request->get('acreditado') - $request->get('monto'); 
						$comision_total = $request->get('comision') + $comision ; 
						$saldo = $acreditado + $comision_total; 

						$actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['acreditado' => $acreditado]);

			            $actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['comision' => $comision_total]);

				        $actualizar =	DB::table('empresa')
			             ->where('id', $miempresa)
			            ->update(['saldo' => $saldo]);
			            
		        	}else{
		        		$monto_r = ($request->get('acreditado') - $request->get('monto'))+($request->get('comision')+$comision);

		        		//$acreditado = $request->get('comision') - $request->get('monto');         	
						$comision_total = $request->get('comision') + $comision ; 
						$saldo = $acreditado + $comision_total; 
						$actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['acreditado' => 0]);

		        		$actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['comision' => $monto_r]);

			            $actualizar =	DB::table('empresa')
		             ->where('id', $miempresa)
		            ->update(['saldo' => $monto_r]);
		        	}
		            //FIN Actualización de saldos-------v>>>>
				}
								

				return response()->json([
					"response" => $response,
					"transaccion" =>$transaccion]
				);

			}else{
				//dd($transaccion->id);
				//$id = DB::table('transaccion')->select('id')->where('id',$transaccion->id)->first();
				//dd($id);
				$cola = ModTransaccion::where("id_estado",'7')->first();

				if($cola){
					
					$mensaje = "No se realizó la recarga. Por favor intente nuevamente.";
		            $titulo = "ERROR ";//.$codigoRespuesta.": ".$mensajeRespuesta;
		            $type = "error";
		            $button = "btn-danger";
                    $buttonText= "OK";
					//INICIO actualización estado de la transaccion
					$transaccion = ModTransaccion::findOrFail($transaccion->id); 
					$transaccion->id_estado = "3";
					$transaccion->trx = "Reverso en proceso";
					$transaccion->save();

					return response()->json([
						"response" => $response,
						"transaccion" =>$transaccion,
						"mensaje" => $mensaje,
						"titulo" => $titulo,
						"type" =>$type,
						"button" => $button,
						"buttonText" => $buttonText
						]);
				}else{
					$referencia =(string) str_pad($transaccion->id,6,'0',STR_PAD_LEFT);
				$lote = Carbon::now();
				$lote =(string)$lote->format('ymd');
				//dd($lote);
				$monto = number_format($request->get('monto'),2,'','.');
				$monto =str_pad($monto,12,'0',STR_PAD_LEFT);
				//$monto = '000000000030';
				$servicio = "02";
				$tipoTransaccion ="02";
				$codigoProceso = "280000";
				//dd($monto);
				$params =(object) array(
				        'monto' => $monto,
				        'proveedor' => (string)$request->get('id_proveedor'),
				        'cuenta' => (string)$request->get('codigo_cliente'),
				        'referencia' => $referencia,
				        'lote' => $lote,
				        'servicio' => $servicio,
				        'tipoTransaccion' => $tipoTransaccion,
				        'codigoProceso' => $codigoProceso,
				    	);

				//if($request->get('acreditado'))
				//dd( $request->get('monto'));
				//try {
				$cliente = SoapCliente::recargas($params);
				/*} catch (Exception $e) {
			        $transaccion = ModTransaccion::findOrFail($transaccion->id); 
						$transaccion->id_estado = "7";
						$transaccion->trx = $codigoRespuesta.':'.$mensajeRespuesta.$a;
						$transaccion->save();
						//FIN actualización estado de la transaccion
						$referencia =(string) str_pad($transaccion->id,6,'0',STR_PAD_LEFT);
						$lote = Carbon::now();
						$lote =(string)$lote->format('Ymd');
						$monto = number_format($request->get('monto'),2,'','.');
						$monto =str_pad($monto,12,'0',STR_PAD_LEFT);
						$servicio = "02";
						$tipoTransaccion ="11";
						$codigoProceso = "280000";
						//dd($monto);
						$params =(object) array(
						        'monto' => $monto,
						        'proveedor' => (string)$request->get('id_proveedor'),
						        'cuenta' => (string)$request->get('codigo_cliente'),
						        'referencia' => $referencia,
						        'lote' => $lote,
						        'servicio' => $servicio,
						        'tipoTransaccion' => $tipoTransaccion,
						        'codigoProceso' => $codigoProceso,
						    	);

						for ($i=0; $i <=3; $i++) { 
							//if($request->get('acreditado'))
							//dd( $request->get('monto'));
							$cliente = SoapCliente::recargas($params);
							$mensaje = explode(">\n", $cliente->peticionRequerimientoResult);
							
							$xml = simplexml_load_string($cliente->peticionRequerimientoResult);
							//var_dump($xml);
							$codigoRespuesta= $xml->codigoRespuesta;
							$numeroAutorizacion = $xml->numeroAutorizacion;
							$mensajeRespuesta = $xml->mensajeRespuesta;
							$a = $codigoRespuesta.' '.$mensajeRespuesta;
							//sleep(3);


						}

						$mensaje = "No se realizó la recarga. Por favor intente nuevamente.";
					            $titulo = "ERROR ";//.$codigoRespuesta.": ".$mensajeRespuesta;
					            $type = "error";
					            $button = "btn-danger";
				                $buttonText= "OK";
								//INICIO actualización estado de la transaccion
								$transaccion = ModTransaccion::findOrFail($transaccion->id); 
								$transaccion->id_estado = "3";
								$transaccion->trx = $codigoRespuesta.':'.$mensajeRespuesta.$a;
								$transaccion->save();
								//FIN actualización estado de la transaccion
								return response()->json([
									"response" => $response,
									"transaccion" =>$transaccion,
									"mensaje" => $mensaje,
									"titulo" => $titulo,
									"type" =>$type,
									"button" => $button,
									"buttonText" => $buttonText
									]);

					//}
					
			    }*/
				$mensaje = explode(">\n", $cliente->peticionRequerimientoResult);
				
				$xml = simplexml_load_string($cliente->peticionRequerimientoResult);
				//var_dump($xml);
				$codigoRespuesta= $xml->codigoRespuesta;
				$numeroAutorizacion = $xml->numeroAutorizacion;
				$mensajeRespuesta = $xml->mensajeRespuesta;

				//Si la respuesta del servidor es exitosa
				if($codigoRespuesta == "00"){
					//INICIO actualización estado de la transaccion
					$transaccion = ModTransaccion::findOrFail($transaccion->id); 
					$transaccion->id_estado = "2";
					$transaccion->trx = $numeroAutorizacion;
					$transaccion->save();
					//FIN actualización estado de la transaccion

					//INICIO generación de ganancia por transacción
					//$producto = CRUDBooster::get('productos','id = '.$request->get('id_producto'))->first();
					$producto = DB::table('productos')->select('*')->where('id',$request->get('id_producto'))->where('id_empresa',$miempresa)->first();

					$comision = ($request->get('monto') * $producto->porcentaje)/100;
					
					
					$transaccion =  new ModTransaccion;
					$transaccion->id_empresa = $miempresa;
					$transaccion->trx = $numeroAutorizacion;
					$transaccion->codigo_cliente = $request->get('codigo_cliente');
					$transaccion->id_producto = $request->get('id_producto');
					$transaccion->id_estado = '2';

					
					$transaccion->monto = $comision;
					$transaccion->id_tipo_transaccion = 3;
					$transaccion->save();
					//FIN generación de ganancia por transacción
					
					$monto_r = $request->get('acreditado') - $request->get('monto');

					//INICIO Actualización de saldos-------v>>>>
					if($request->get('acreditado') > 0 && $monto_r >= 0){
						$acreditado = $request->get('acreditado') - $request->get('monto'); 
						$comision_total = $request->get('comision') + $comision ; 
						$saldo = $acreditado + $comision_total; 

						$actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['acreditado' => $acreditado]);

			            $actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['comision' => $comision_total]);

				        $actualizar =	DB::table('empresa')
			             ->where('id', $miempresa)
			            ->update(['saldo' => $saldo]);
			            
		        	}else{
		        		$monto_r = ($request->get('acreditado') - $request->get('monto'))+($request->get('comision')+$comision);

		        		//$acreditado = $request->get('comision') - $request->get('monto');         	
						$comision_total = $request->get('comision') + $comision ; 
						$saldo = $acreditado + $comision_total; 
						$actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['acreditado' => 0]);

		        		$actualizar =	DB::table('empresa')
			            ->where('id', $miempresa)
			            ->update(['comision' => $monto_r]);

			            $actualizar =	DB::table('empresa')
		             ->where('id', $miempresa)
		            ->update(['saldo' => $monto_r]);
		        	}
		            //FIN Actualización de saldos-------v>>>>

		            $mensaje = "Se raliza la recarga de <span style='color:#000000'>$".$request->get('monto') ."</span> al número <span style='color:#000000'>".$request->get('codigo_cliente')."</span>";
		            $titulo = "Buen Trabajo";
		            $type = "success";
		            $button = "btn-succes";
                    $buttonText= "OK";

				}else{
					if($codigoRespuesta == "ER"){
						//INICIO actualización estado de la transaccion
						$transaccion = ModTransaccion::findOrFail($transaccion->id); 
						$transaccion->id_estado = "7";
						$transaccion->trx = $codigoRespuesta.':d-'.$mensajeRespuesta.$a;
						$transaccion->save();
						//FIN actualización estado de la transaccion
						$referencia =(string) str_pad($transaccion->id,6,'0',STR_PAD_LEFT);
						$lote = Carbon::now();
						$lote =(string)$lote->format('ymd');
						$monto = number_format($request->get('monto'),2,'','.');
						$monto =str_pad($monto,12,'0',STR_PAD_LEFT);
						$servicio = "02";
						$tipoTransaccion ="11";
						$codigoProceso = "280000";
						//dd($monto);
						$params =(object) array(
						        'monto' => $monto,
						        'proveedor' => (string)$request->get('id_proveedor'),
						        'cuenta' => (string)$request->get('codigo_cliente'),
						        'referencia' => $referencia,
						        'lote' => $lote,
						        'servicio' => $servicio,
						        'tipoTransaccion' => $tipoTransaccion,
						        'codigoProceso' => $codigoProceso,
						    	);

						//for ($i=0; $i <=3; $i++) { 
							//if($request->get('acreditado'))
							//dd( $request->get('monto'));
							$cliente = SoapCliente::recargas($params);
							$cliente = SoapCliente::recargas($params);
							$cliente = SoapCliente::recargas($params);
							$mensaje = explode(">\n", $cliente->peticionRequerimientoResult);
							
							$xml = simplexml_load_string($cliente->peticionRequerimientoResult);
							//var_dump($xml);
							$codigoRespuesta´= $xml->codigoRespuesta;
							$numeroAutorizacion = $xml->numeroAutorizacion;
							$mensajeRespuesta = $xml->mensajeRespuesta;
							$a = $codigoRespuesta.' '.$mensajeRespuesta;
							sleep(3);

						//}
					}
					if($codigoRespuesta == "09" || $codigoRespuesta == "27" || $codigoRespuesta == "01" || $codigoRespuesta == "17" || $codigoRespuesta == "18" || $codigoRespuesta == "21" || $codigoRespuesta == "70" || $codigoRespuesta == "71" || $codigoRespuesta == "72" || $codigoRespuesta == "73" || $codigoRespuesta == "74" || $codigoRespuesta == "80" || $codigoRespuesta == "81" ||  $codigoRespuesta == "91" || $codigoRespuesta == ""){
						//INICIO actualización estado de la transaccion
						$transaccion = ModTransaccion::findOrFail($transaccion->id); 
						$transaccion->id_estado = "7";
						$transaccion->trx = $codigoRespuesta.':-'.$mensajeRespuesta.$a;
						$transaccion->save();
						//FIN actualización estado de la transaccion
						$referencia =(string) str_pad($transaccion->id,6,'0',STR_PAD_LEFT);
						$lote = Carbon::now();
						$lote =(string)$lote->format('ymd');
						$monto = number_format($request->get('monto'),2,'','.');
						$monto =str_pad($monto,12,'0',STR_PAD_LEFT);
						$servicio = "02";
						$tipoTransaccion ="11";
						$codigoProceso = "280000";
						//dd($monto);
						$params =(object) array(
						        'monto' => $monto,
						        'proveedor' => (string)$request->get('id_proveedor'),
						        'cuenta' => (string)$request->get('codigo_cliente'),
						        'referencia' => $referencia,
						        'lote' => $lote,
						        'servicio' => $servicio,
						        'tipoTransaccion' => $tipoTransaccion,
						        'codigoProceso' => $codigoProceso,
						    	);

						for ($i=0; $i <=3; $i++) { 
							//if($request->get('acreditado'))
							//dd( $request->get('monto'));
							$cliente = SoapCliente::recargas($params);
							$mensaje = explode(">\n", $cliente->peticionRequerimientoResult);
							
							$xml = simplexml_load_string($cliente->peticionRequerimientoResult);
							//var_dump($xml);
							$codigoRespuesta´= $xml->codigoRespuesta;
							$numeroAutorizacion = $xml->numeroAutorizacion;
							$mensajeRespuesta = $xml->mensajeRespuesta;
							$a = $codigoRespuesta.' '.$mensajeRespuesta;
							sleep(3);

						}

					}
					$mensaje = "No se realizó la recarga. Por favor intente nuevamente.";
		            $titulo = "ERROR ";//.$codigoRespuesta.": ".$mensajeRespuesta;
		            $type = "error";
		            $button = "btn-danger";
                    $buttonText= "OK";
					//INICIO actualización estado de la transaccion
					$transaccion = ModTransaccion::findOrFail($transaccion->id); 
					$transaccion->id_estado = "3";
					$transaccion->trx = $codigoRespuesta.':'.$mensajeRespuesta.$a;
					$transaccion->save();
					//FIN actualización estado de la transaccion
				}
				return response()->json([
						"response" => $response,
						"transaccion" =>$transaccion,
						"mensaje" => $mensaje,
						"titulo" => $titulo,
						"type" =>$type,
						"button" => $button,
						"buttonText" => $buttonText
						]);
				}
				
				

			}
			
		}

		public function storeAcreditacion(Request $request)
		{
			//dd( $request->get('monto'));
			$usuario=CRUDBooster::get('cms_users','id = '.CRUDBooster::myId().' ')->first();    	
    		$miempresa = $usuario->id_empresa;
			$transaccion =  new ModTransaccion;
			$transaccion->id_empresa = $miempresa;			
			$transaccion->trx = $request->get('trx');
			$transaccion->codigo_cliente = $request->get('codigo_cliente');
			$transaccion->id_producto = $request->get('id_producto');
			$transaccion->id_estado = $request->get('id_estado');
			$transaccion->monto = $request->get('monto');
			$transaccion->id_tipo_transaccion = $request->get('id_tipo_transaccion');

			
    		
			$response = $transaccion->save();
			return response()->json([
				"response" => $response,
				"transaccion" =>$transaccion]);
		}

		public function consultarSaldo($id){
			$saldo = DB::table('empresa')->select('acreditado','comision','saldo')->where('id',$id)->first();
			//$saldo = CRUDBooster::get('saldos','id = '.$id)->first();
			return $saldo;

		}

		public function porcentaje($id,$monto){
			$producto = CRUDBooster::get('producto','id = '.$id)->first();
			dd($producto);

		}

		
		


	}