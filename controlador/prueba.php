<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PrincipalController extends BaseController {

	private $_api_context;

	public function __construct()
	{
	 // setup PayPal api context
	 $paypal_conf = Config::get('paypal');
	 $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
	 $this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function postPayment()
	{
	$payer = new Payer();
	$payer->setPaymentMethod('paypal');

	$item_1 = new Item();
	$item_1->setName('Recarga Ola Telefonia') // item name
	    ->setCurrency('USD')
	    ->setQuantity(1)
	    ->setPrice(Input::get('valor')); // unit price

	// add item to list
	$item_list = new ItemList();
	$item_list->setItems(array($item_1));

	$amount = new Amount();
	$amount->setCurrency('USD')
	    ->setTotal(Input::get('valor'));

	$transaction = new Transaction();
	$transaction->setAmount($amount)
	    ->setItemList($item_list)
	    ->setDescription('Recarga Ola telefonia');

	$redirect_urls = new RedirectUrls();
	$redirect_urls->setReturnUrl(URL::route('payment.status'))
	    ->setCancelUrl(URL::route('payment.status'));

	$payment = new Payment();
	$payment->setIntent('Sale')
	    ->setPayer($payer)
	    ->setRedirectUrls($redirect_urls)
	    ->setTransactions(array($transaction));

	try {
	    $payment->create($this->_api_context);
	} catch (\PayPal\Exception\PPConnectionException $ex) {
	    if (\Config::get('app.debug')) {
	        echo "Exception: " . $ex->getMessage() . PHP_EOL;
	        $err_data = json_decode($ex->getData(), true);
	        exit;
	    } else {
	        die('Some error occur, sorry for inconvenient');
	    }
	}

	foreach($payment->getLinks() as $link) {
	    if($link->getRel() == 'approval_url') {
	        $redirect_url = $link->getHref();
	        break;
	    }
	}

	// add payment ID to session
	Session::put('paypal_payment_id', $payment->getId());
	Session::put('montorecarga', Input::get('valor'));

	if(isset($redirect_url)) {
	    // redirect to paypal
	    return Redirect::away($redirect_url);
	}

	return Redirect::route('/recarga')
	    ->with('error', 'Su transaccion no pudo ser realizada');
	}

	public function getPaymentStatus()
	{
	// Get the payment ID before session clear
	$payment_id = Session::get('paypal_payment_id');
	$monto = Session::get('montorecarga');

	// clear the session payment ID
	Session::forget('paypal_payment_id');

	if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
	    return Redirect::to('/')
	        ->with('error', 'Pago Cancelado o Rechazado');
	}

	$payment = Payment::get($payment_id, $this->_api_context);

	// PaymentExecution object includes information necessary 
	// to execute a PayPal account payment. 
	// The payer_id is added to the request query parameters
	// when the user is redirected from paypal back to your site
	$execution = new PaymentExecution();
	$execution->setPayerId(Input::get('PayerID'));

	//Execute the payment
	$result = $payment->execute($execution, $this->_api_context);

	//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

	if ($result->getState() == 'approved') { // payment made
	    if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);
		 	$card->credit=$card->credit+$monto;
		 	$card->save();
		 	return Redirect::to('/saldo')->with('saldo',$card->credit)->with('nombre',$card->firstname);
		}
		else
		{
			return Redirect::to('/login')->with('mensaje', 'Su transaccion ha sido realizada por favor inicie sesion');
		}
	}
	return Redirect::to('/')
	    ->with('error', 'Pago Cancelado o Rechazado');
	}

	public function getIndex()
	{
		$usr=Auth::user();
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();
		if($usr)
		{
			if($usr->tipo_usuario=='ADMINISTRADOR' )
			{
				return Redirect::to('/distribuidores');
			}elseif($usr->tipo_usuario=='CAJERO')
			{
				return Redirect::to('/distribuidores');
			}else
			{
				$card=Usuario::find($usr->id_card);
			 return View::make('index')->with('opcion',1)->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('mipais',$mipais)->render();
			}
		}else{
			return View::make('index')->with('opcion',1)->with('mipais',$mipais)->render();
		}
		
	}

	public function getAcercaDeOlaTelefonia()
	{
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('acerca')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('mipais',$mipais)->render();
		}
		else
		{
			return View::make('acerca')->with('mipais',$mipais)->render();
		}
	}

	public function getServicioAlCliente()
	{
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('servicio-al-cliente')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('mipais',$mipais)->render();
		}
		else
		{
			return View::make('servicio-al-cliente')->with('mipais',$mipais)->render();
		}
	}

	public function getServicios()
	{
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('servicios')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('mipais',$mipais)->render();
		}
		else
		{
			return View::make('servicios')->with('mipais',$mipais)->render();
		}
	}

	public function getTarifas()
	{
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('paises.nombre',        	
	        	'paises.bandera',
	        	'celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();

			$paises=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('paises.nombre',        	
	        	'paises.bandera',
	        	'celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->groupBy('paises.nombre')
	        ->get();
	        $prefijos=Prefijo::all();

	        $rates=DB::table('cc_ratecard')
	        ->leftJoin('cc_prefix as pref', function($join)
	        {
	            $join->on('cc_ratecard.dialprefix', '=', 'pref.prefix');
	        })
	        ->select('pref.destination as destination','cc_ratecard.rateinitial as buyrate')
	        ->get();

		if(Auth::check())
			{
				$card=Usuario::find(Auth::user()->id_card);
				return View::make('tarifas')->with('prefijos',$prefijos)->with('mipais',$mipais)->with('paises',$paises)->with('nombre',$card->firstname)
				->with('saldo',$card->credit)->with('rates',$rates)->render();
			}
			else
			{
				return View::make('tarifas')->with('prefijos',$prefijos)->with('mipais',$mipais)->with('paises',$paises)->with('rates',$rates)->render();
			}
	}

	public function getLogin()
	{
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('login')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('mipais',$mipais)->render();
		}
		else
		{
			return View::make('login')->with('mipais',$mipais)->render();
		}
	}

	public function getOlvidoContrasena()
	{
		return View::make('olvido-contrasena')->render();
	}

	public function postRecuperarContrasena(){
			Mail::send('emails.recuperacion', 
			array('enlace' => 'http://olacolombia.com/'),
			 function($message)
			{
			    $message->to(Input::get('correo'), 'Estimado usuario')->subject('Recuperacion Cuenta Ola Telefonia!');
			});
			return View::make('olvido-contrasena')->render();
	}

	public function getSignup()
	{
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('signup')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('mipais',$mipais)->render();
		}
		else
		{
			return View::make('signup')->with('mipais',$mipais)->render();
		}
	}

	public function getAreaCliente()
	{
		if(Auth::check())
	{
	 	$card=Usuario::find(Auth::user()->id_card);		 	
	 	return View::make('area-cliente')->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
	}
	else
	{
		return View::make('login')->render();
	}
	}

	public function getDirectorio()
	{
		if(Auth::check())
	{
		 $usr=Auth::user();
		 $directorio=Directorio::where('id_usuario','=',$usr->id)->get();
	 	$card=Usuario::find(Auth::user()->id_card);		 	
	 	return View::make('directorio')->with('directorio',$directorio)->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
	}
	else
	{
		return View::make('login')->render();
	}
	}

	public function getHistorial()
	{
		if(Auth::check())
	{
			$llamadas=DB::table('cc_call')->where('card_id','=',Auth::user()->id_card)
				->select('starttime as inicio_llamada','stoptime as fin_llamada','calledstation as destino',
					'sessiontime as tiempo','sessionbill as valor')->get();
	 	$card=Usuario::find(Auth::user()->id_card);		 	
	 	return View::make('historial')->with('llamadas',$llamadas)->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
	}
	else
	{
		return View::make('login')->render();
	}
	}

	public function getDatos()
	{
		if(Auth::check())
	{
		 $usr=Auth::user();
	 	$card=Usuario::find(Auth::user()->id_card);		 	
	 	return View::make('datos')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('usuario',$usr)
				->with('tarjeta',$card)->render();
	}
	else
	{
		return View::make('login')->render();
	}
	}

	public function getSaldo()
	{ 	
		if(Auth::check())
	{
	 	$card=Usuario::find(Auth::user()->id_card);		 	
	 	return View::make('saldo')->with('saldo',$card->credit)->with('nombre',$card->firstname)->render();
	}
	else
	{
		return View::make('login')->render();
	}
	}

	public function getRecarga()
	{
		if(Auth::check())
	{
	 	$card=Usuario::find(Auth::user()->id_card);		 	
	 	return View::make('recarga')->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
	}
	else
	{
		return View::make('login')->render();
	}
	}

	public function getConfiguracion()
	{
		if(Auth::check())
	{
		 $card=Usuario::find(Auth::user()->id_card);
		 $tarjeta=$card->username; 		 	
	 	return View::make('configuracion')->with('nombre',$card->firstname)->with('saldo',$card->credit)
	 	->with('tarjeta',$tarjeta)->with('codtarjeta',$card->uipass)->render();
	}
	else
	{
		return View::make('login')->render();
	}
	}

	public function getContactanos()
	{
		$informacionurl= View::make('contenido.contactanos')->with('opcion',1)->render();
		if(Auth::check())
	{
		$card=Usuario::find(Auth::user()->id_card);
		return View::make('index')->with('informacionurl',$informacionurl)->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
	}
	else
	{
		return View::make('index')->with('informacionurl',$informacionurl)->render();
	}
	}

	public function getAyuda()
	{
		$mipais=DB::table('paises')
	        ->leftJoin('cc_ratecard as celular', function($join)
	        {
	            $join->on('paises.celular', '=', 'celular.dialprefix');
	        })
	        ->leftJoin('cc_ratecard as fijo', function($join)
	        {
	            $join->on('paises.fijo', '=', 'fijo.dialprefix');
	        })
	        ->select('celular.rateinitial as celular',
	        	'fijo.rateinitial as fijo')
	        ->where('paises.nombre','=','Colombia')
	        ->first();
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('ayuda')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('mipais',$mipais)->render();
		}
		else
		{
			return View::make('ayuda')->with('mipais',$mipais)->render();
		}
	}

	public function getLlamadaGratuita()
	{
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('llamada')->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
		}
		else
		{
			return View::make('llamada')->render();
		}
	}

	public function postLlamando()
	{
		if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('llamada2')->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
		}
		else
		{
			return View::make('llamada2')->render();
		}
	}

	public function postRegistrarUsuario()
	{		
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LckFwQTAAAAAKPDoAae9O8JJPIcdr0Ap6wlupfe&response=".Input::get('g-recaptcha-response')), true);
        if($response['success'] == false)
        {
        	return View::make('/signup')->with('mensaje','No has superado la prueba de captcha')->render();
        }else{

			if(!User::where('email','=',Input::get('email'))->first())
			{
				$usr= New User;
				$usuario= New Usuario;
				$fecha = date("Y-m-d H:i:s");
				$expiracion = strtotime ( '+10 year' , strtotime ( $fecha ) ) ;
				$expiracion = date ( 'Y-m-d H:i:s' , $expiracion );
				$usuario->expirationdate=$expiracion;
				$numero_aleratorio=rand(1000000000, 9999999999);
				$phone1=str_replace("(","",Input::get('telefono'));
				$phone2=str_replace(")","",$phone1);
				if(Usuario::where('username','=',$phone2)->first())
				{
					return View::make('/signup')->with('mensaje','numero ya registrado')->render();
				}
				$usuario->username=$phone2;
				$usuario->useralias=$phone2;
				/*$usuario->username=Input::get('telefono');
				$usuario->useralias=Input::get('telefono');*/
				$usuario->uipass=rand(1000000000, 9999999999);
				$usr->password=Input::get('password');

				$codigo_promocional=CodigoPromocional::where('codigo','=',Input::get('codigo_promocional'))->first();
				if($codigo_promocional){
					$usuario->credit=1+$codigo_promocional->valor;
					$codigo_promocional->delete();
				}else{
					$usuario->credit=1;
				}

				$usuario->tariff=1;
				$usuario->id_didgroup=-1;
				$usuario->lastname=Input::get('apellidos');
				$usuario->firstname=Input::get('nombres');
				$usuario->address=Input::get('direccion');
				$usuario->city=Input::get('ciudad');
				$usuario->state=Input::get('estado');
				$usuario->country=Input::get('pais');
				$usuario->zipcode=Input::get('codigo_postal');				
				//$usuario->phone=Input::get('telefono');
				$usuario->phone=$phone2;
				$usuario->email=Input::get('email');
				$usr->email=Input::get('email');
				$usuario->simultaccess=0;
				$usuario->max_concurrent=2;
				$usuario->sip_buddy=1;
				$usuario->language="es";
				$usuario->redial=5753850962;
				$usuario->id_campaign=-1;
				$usuario->id_timezone=Input::get('zona_horaria');
				$usuario->traffic=0;
				$usuario->id_seria=-1;
				$usuario->lock_pin=0;
				$usuario->save();
				$usr->plan_llamada=Input::get('plan_llamadas');
				$usr->nombre_compañia=Input::get('nombre_compañia');
				$usr->registro_iva=Input::get('registro_iva');
				$usr->id_card=$usuario->id;
				$usr->save();
				$cuentasip= New CuentaSip;
				$cuentasip->id_cc_card=$usuario->id;
				$cuentasip->name=$usuario->username;
				$cuentasip->accountcode=$usuario->username;
				$cuentasip->regexten=$usuario->username;
				$cuentasip->amaflags='billing';
				$cuentasip->context='a2billing';
				$cuentasip->port='47235';
				$cuentasip->secret=$usuario->uipass;
				$cuentasip->username=$usuario->username;
				$cuentasip->allow='ulaw,alaw';
				$cuentasip->regseconds=1419104590;
				$cuentasip->ipaddr='186.119.44.106';
				$cuentasip->fullcontact='sip:9949191677@186.119.44.106:47235^3Btransport=UDP^3Brinstance=248761f3eea51ef9';
				$cuentasip->useragent='Zoiper r28827';
				$cuentasip->save();

				Mail::send('emails.bienvenida', 
				array('nombre' => Input::get('nombres')),
				 function($message)
				{
				    $message->to(Input::get('email'), Input::get('nombres'))->subject('Bienvenido a Ola Telefonia!');
				});

				$userdata = array('email' => Input::get('email'),'password'=> Input::get('password'));
				Auth::attempt($userdata, false);
				$card=Usuario::find($usr->id_card);
				return View::make('/index')->with('mensaje','Bienvenido a Ola Telefonia!')->render();
				/*
				$payer = new Payer();
				$payer->setPaymentMethod('paypal');

				$item_1 = new Item();
				$item_1->setName('Recarga Ola Telefonia') // item name
				    ->setCurrency('USD')
				    ->setQuantity(1)
				    ->setPrice(Input::get('valor')); // unit price

				// add item to list
				$item_list = new ItemList();
				$item_list->setItems(array($item_1));

				$amount = new Amount();
				$amount->setCurrency('USD')
				    ->setTotal(Input::get('valor'));

				$transaction = new Transaction();
				$transaction->setAmount($amount)
				    ->setItemList($item_list)
				    ->setDescription('Recarga Ola telefonia');

				$redirect_urls = new RedirectUrls();
				$redirect_urls->setReturnUrl(URL::route('payment.status'))
				    ->setCancelUrl(URL::route('payment.status'));

				$payment = new Payment();
				$payment->setIntent('Sale')
				    ->setPayer($payer)
				    ->setRedirectUrls($redirect_urls)
				    ->setTransactions(array($transaction));

				try {
				    $payment->create($this->_api_context);
				} catch (\PayPal\Exception\PPConnectionException $ex) {
				    if (\Config::get('app.debug')) {
				        echo "Exception: " . $ex->getMessage() . PHP_EOL;
				        $err_data = json_decode($ex->getData(), true);
				        exit;
				    } else {
				        die('Some error occur, sorry for inconvenient');
				    }
				}

				foreach($payment->getLinks() as $link) {
				    if($link->getRel() == 'approval_url') {
				        $redirect_url = $link->getHref();
				        break;
				    }
				}

				// add payment ID to session
				Session::put('paypal_payment_id', $payment->getId());
				Session::put('montorecarga', Input::get('valor'));

				if(isset($redirect_url)) {
				    // redirect to paypal
				    return Redirect::away($redirect_url);
				}

				return Redirect::route('/recarga')
				    ->with('error', 'Su transaccion no pudo ser realizada');*/
			}else{
				return View::make('/signup')->with('mensaje','email ya registrado')->render();
			}
		}			
	}

	public function getConfirmarPago()
	{
		if(Input::get('payment_status')=="Completed" && !Pago::where('txn_id','=',Input::get('txn_id'))->first())
		{
			$p=new Pago;
			$p->monto=Input::get('mc_gross');
			$p->txn_id=Input::get('txn_id');
			$p->save();
			$c=Usuario::where('id','=','3')->first();
			$c->credit=$c->credit+$p->monto;
			$c->save();
			return "pago realizado con exito";
		}
		else
		{
			return "pago no completado o ya efectuado";
		}
		//return Input::get('mc_gross');monto
		//return Input::get('receiver_id');mi id paypal
		//return Input::get('payment_status');Completed
		//return Input::get('txn_id');id transaccion
		//return Input::get('mc_currency');USD moneda
	}

	public function postCargarCodigoPromocional(){
		$codigo_promocional=CodigoPromocional::where('codigo','=',Input::get('codigo_promocional'))->first();
		if($codigo_promocional){
			$card=Usuario::find(Auth::user()->id_card);
			$card->credit=$card->credit+$codigo_promocional->valor;
			$card->save();
			$codigo_promocional->delete();
			return "Se ha cargado su codigo promocional";
		}else{
			return "Codigo promocional no valido";
		}
	}

	public function postModalOlvideContrasena()
	{
		$vista= View::make('contenido.modal.olvidecontrasena')->render();	
		return Response::json(array('vista'=>$vista));
	}

	public function getVideos()
	{
		$vt=VideoTutorial::all();

	 	if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('videos')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('videos',$vt)->render();
		}
		else
		{
			return View::make('videos')->with('videos',$vt)->render();
		}

	}

	public function getDescarga()
	{
		$descargas=Descarga::all();

	 	if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('descargas')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('descargas',$descargas)->render();
		}
		else
		{
			return View::make('descargas')->with('descargas',$descargas)->render();
		}

	}

	public function getPreguntasFrecuentes()
	{
		$categorias=CategoriasPreguntas::all();
		$preguntas=PreguntasFrecuente::all();

	 	if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('preguntas-frecuentes')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('preguntas',$preguntas)->render();
		}
		else
		{
			return View::make('preguntas-frecuentes')->with('preguntas',$preguntas)->render();
		}

	}

	public function getIndicativos()
	{
		$prefijos=Prefijo::all();

	 	if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('ayuda-indicativos')->with('nombre',$card->firstname)->with('saldo',$card->credit)
		 	->with('prefijos',$prefijos)->render();
		}
		else
		{
			return View::make('ayuda-indicativos')->with('prefijos',$prefijos)->render();
		}

	}

	public function getIndicativosTarifas()
	{
		$prefijos=Prefijo::all();

	 	if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('tarifas-indicativos')->with('nombre',$card->firstname)->with('saldo',$card->credit)
		 	->with('prefijos',$prefijos)->render();
		}
		else
		{
			return View::make('tarifas-indicativos')->with('prefijos',$prefijos)->render();
		}

	}

	public function getMapaDelSitio()
	{
	 	if(Auth::check())
		{
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('mapa')->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
		}
		else
		{
			return View::make('mapa')->render();
		}

	}

	public function postVideoTutorial()
	{
		$v=VideoTutorial::find(Input::get('id_video'));
		$vista= View::make('contenido.video')->with('video',$v)->render();	
		return Response::json(array('vista'=>$vista));
	}

	public function postCambiarContrasena()
	{
		$usr=Auth::user();
		if(Hash::check(Input::get('vieja'), $usr->password) && Input::get('nueva')==Input::get('confirmacion'))
		{			
			$usr->password=Input::get('confirmacion');
			$usr->save();
			return View::make('index')->with('opcion',1)->with('alertas','Contraseña ha sido cambiada')->render();
		}else
		{
			return View::make('index')->with('opcion',1)->with('alertad','Contraseña no pudo ser cambiada')->render();
		}		
	}

	public function postOlvideContrasena()
	{
		$numero_aleratorio=rand(1000000000, 9999999999);
		$usr=User::where('email','=',Input::get('email'))->first();
		if($usr)
		{
			$usr->password=$numero_aleratorio;
			$usr->save();
			Mail::send('emails.registro', 
			array('nombre' => Input::get('email'),'correo' => Input::get('email'),'contraseña' => $numero_aleratorio),
			 function($message)
			{
			    $message->to(Input::get('email'), Input::get('email'))->subject('Recuperacion Contraseña Ola Telefonia!');
			});
			return View::make('index')->with('opcion',1)->with('alertas','Correo de recuperacion enviado')->render();
		}
		else
		{
			return View::make('index')->with('opcion',1)->with('alertad','Correo no registrado en Ola Telefonia')->render();
		}
			
	}
	
	public function postActualizarDatos()
	{
		if(Auth::check())
		{
			$usr=Auth::user();
			$card=Usuario::find(Auth::user()->id_card);	
			$card->lastname=Input::get('apellidos');
			$card->firstname=Input::get('nombres');
			$card->address=Input::get('direccion');
			$card->city=Input::get('ciudad');
			$card->state=Input::get('estado');
			$card->country=Input::get('pais');
			$card->phone=Input::get('telefono');
			$card->save();
			return View::make('datos')->with('nombre',$card->firstname)->with('saldo',$card->credit)->with('usuario',$usr)
					->with('tarjeta',$card)->render();
		}
		else
		{
			return View::make('login')->render();
		}
	}

	public function postGuardarContacto()
	{	
		if(Auth::check())
		{
				$usr=Auth::user();
				$contacto=new Directorio;
				$contacto->nombre=Input::get('nombre');
				$contacto->numero=Input::get('numero');
				$contacto->id_usuario=$usr->id;
				$contacto->save();
			 $directorio=Directorio::where('id_usuario','=',$usr->id)->get();
		 	$card=Usuario::find(Auth::user()->id_card);		 	
		 	return View::make('directorio')->with('directorio',$directorio)->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
		}
		else
		{
			return View::make('login')->render();
		}
	}

	public function postEliminarContacto()
	{		
		if(Auth::check())
		{
			$usr=Auth::user();
			$contacto=Directorio::find(Input::get('id'));
			$contacto->delete();
			$directorio=Directorio::where('id_usuario','=',$usr->id)->get();
	 		$card=Usuario::find(Auth::user()->id_card);		 	
	 		return View::make('directorio')->with('directorio',$directorio)->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
		}
		else
		{
			return View::make('login')->render();
		}
	}

	public function postEnviarMensaje(){
		Mail::send('emails.serviciocliente', 
			array('nombre' => Input::get('nombre'),'email' => Input::get('email'),'mensaje' => Input::get('mensaje')),
			 function($message)
			{
			    $message->to('olatelefonia@emsitel.com.co', Input::get('nombre'))->subject(Input::get('asunto'));
			});
		return View::make('servicio-al-cliente')->with('confirmacion','Mensaje enviado correctamente');
	}

	public function postIniciarSesion(){
		$userdata = array('email' => Input::get('usuario'),'password'=> Input::get('password'));
		if(Auth::attempt($userdata, false))
		{
			Session::forget('intentos');
			$usr=Auth::user();
			$card=Usuario::find($usr->id_card);
			return View::make('area-cliente')->with('nombre',$card->firstname)->with('saldo',$card->credit)->render();
		}else
		{
			if(!Session::has('intentos'))
			{
			    Session::put('intentos', 5);
			}else
			{
				Session::put('intentos', Session::get('intentos')-1);
			}
			return View::make('login')->with('opcion',1)->with('error','Usuario o contraseña errada. '.(Session::get('intentos')).' intentos restantes')->render();
		}
	}

	public function getCerrarSesion()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function getPagoCancelado()
	{
		return Input::get('payment_status');
	}

	public function getPagoRealizado()
	{
		return Input::get('payment_status');
	}

}
