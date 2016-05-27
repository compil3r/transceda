<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Historias;
use App\User;
use App\Doacoes; 

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
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Address;

class PaypalController extends Controller
{
	private $_api_context;
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
	public function postPayment(Request $request)
	{

		\Session::put('doador', $request->get('doador'));
		\Session::put('recebedor', $request->get('recebedor'));

		$addr = new Address();
		$addr->setLine1('52 N Main ST');
		$addr->setCity('Johnstown');
		$addr->setCountryCode('BR');
		$addr->setPostalCode('43210');
		$addr->setState('RS');

		/*		
		
		$card = new CreditCard();
		$card->setNumber("4002356531411474")
		->setType("visa")
		->setExpireMonth("05")
		->setExpireYear("2021")
		->setCvv2("111")
		->setFirstName("Vitor")
		->setLastName("Buyer")
		->setBillingAddress($addr);


		$fundingInstruments = new FundingInstrument();
		$fundingInstruments->setCreditCard($card);

		$payer = new Payer();
		$payer->setPaymentMethod('credit_card')
		->setFundingInstruments($fundingInstruments);
		*/

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$currency = 'BRL';

		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($request->get('valor'));

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setDescription('Pedido de prueba en mi Laravel App Store');

		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));
		
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
				die('Ups! Algo salió mal');
			}
		}
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
		return \Redirect::route('cart-show')
			->with('error', 'Ups! Error desconocido.');
	}


	public function getPaymentStatus()
	{
		//Pagando o ID do pagamento
		$payment_id = \Session::get('paypal_payment_id');
		//Apagando o ID do pagamento da Sessao
		\Session::forget('paypal_payment_id');
		$payerId = \Input::get('PayerID');
		$token = \Input::get('token');
		
		if (empty($payerId) || empty($token)) {
			return \Redirect::route('home')
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}

		$payment = Payment::get($payment_id, $this->_api_context);
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site<
		$execution = new PaymentExecution();
		$execution->setPayerId(\Input::get('PayerID'));
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
		if ($result->getState() == 'approved') { // payment made
			
			$doacao = new Doacoes();
			$doacao->idDoador = \Session::get('doador');
			$doacao->idRecebedor = \Session::get('recebedor');

			print_r("transactions");
			print_r($result->getTransactionDetails());
			$resultado = $result->getTransactionDetails();
			print_r("OK TENTATIVA 1");
			print_r($resultado->amount);

			//return \Redirect::to('home')
			//	->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::to('home')
			->with('message', 'La compra fue cancelada');
	}


}