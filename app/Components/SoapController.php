<?php
namespace App\Components;
 
use SoapClient;
 use SoapHeader;
 use Illuminate\Support\Facades\DB;
 class SoapController
 {
 
    public function recargas($parametros)
    {
    	//dd($parametros);
    		$soapParams = DB::table('soap_parametros')->select('*')->where('estado','1')->first();
            $params = array('tipoTransaccion'=>$parametros->tipoTransaccion,'codigoProceso'=>$parametros->codigoProceso,'monto'=>$parametros->monto,'cajero'=>$soapParams->cajero,'clave'=>$soapParams->clave,'tid'=>$soapParams->tid,'mid'=>$soapParams->mid,'proveedor'=>$parametros->proveedor,'servicio'=>$parametros->servicio,'cuenta'=>$parametros->cuenta,'autorizacion'=>'','referencia'=>$parametros->referencia,'lote'=>$parametros->lote);

            //dd($params);
 			$client = new SoapClient($soapParams->url);
			//var_dump($client->__getFunctions());
           
            $data = $client->peticionRequerimiento($params);
 			//dd($data);
 			//var_dump($data)
            return $data;
 
    }


	public function demo()
	{
	 // Add a new service to the wrapper
	        SoapWrapper::add(function ($service) {
	            $service
	                ->name('currency')
	                ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
	                ->trace(true)                                                   // Optional: (parameter: true/false)
	                ->header()                                                      // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
	                ->cookie()                                                      // Optional: (parameters: $name,$value)
	                ->location()                                                    // Optional: (parameter: $location)
	                ->certificate()                                                 // Optional: (parameter: $certLocation)
	                ->cache(WSDL_CACHE_NONE)                                        // Optional: Set the WSDL cache
	                ->options(['login' => 'username', 'password' => 'password']);   // Optional: Set some extra options
	        });

	        $data = [
	            'CurrencyFrom' => 'USD',
	            'CurrencyTo'   => 'EUR',
	            'RateDate'     => '2014-06-05',
	            'Amount'       => '1000'
	        ];

	        // Using the added service
	        SoapWrapper::service('currency', function ($service) use ($data) {
	            var_dump($service->getFunctions());
	            var_dump($service->call('GetConversionAmount', [$data])->GetConversionAmountResult);
	        });
	}
}
