<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Historias;
use App\User;
use App\Doacoes; 
use App\Saques;
use App\Mensagens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

class DoacoesController extends Controller
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
		\Session::put('valor', $request->get('valor'));
		\Session::put('historia', $request->get('historia'));

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$currency = 'BRL';

		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($request->get('valor'));

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setDescription("Doação para ".Historias::find($request->get('historia'))->autor->name.", no valor de R$". floatval($request->get('valor'))." reais.");

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
				die('Ops, aconteceu algo de errado!');
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
			$doacao->valor = \Session::get('valor');
			$doacao->idHistoria = Session::get('historia');
			$doacao->save();


			$output = new \Symfony\Component\Console\Output\ConsoleOutput(2);

			$historia = Historias::find($doacao->idHistoria)->arrecadado;
			$output->writeln($historia);
			$total = $historia + floatval($doacao->valor);
			$output->writeln($total);
			\DB::table('historias')->where('id', $doacao->idHistoria)->update(['arrecadado' => $total]);


			return \Redirect::route('historia', $doacao->idHistoria)->with('message', 'Sua doação foi processada com sucesso! Obrigado <3');
		}
		return \Redirect::to('home')
			->with('message', 'La compra fue cancelada');
	}

	public function sacar(Request $request) {
		$saque = new Saques();
		$saque->idHistoria = $request->get('idHistoria');
		$saque->titular = $request->get('name');
		$saque->conta = $request->get('conta');
		$saque->banco = $request->get('banco');
		$saque->valor = $request->get('valor');
		$saque->agencia = $request->get('agencia');
		$saque->operacao = $request->get('operacao');
		$saque->status = 1;

		if ($saque->save()) {
			$mensagem = new Mensagens();
			$mensagem->assunto = "Solicitação de saque";
			$mensagem->idRecebedor = Auth::user()->id;
			$mensagem->status = 1;
			$mensagem->mensagem = "Recebemos sua solicitação com sucesso. Vale lembrar que, por conta do volume de solicitações, sua transição pode demorar até 5 (cinco) dias uteis para ser atendida. Assim que obtivermos uma resposta te enviaremos um email com a resposta, bem como uma mensagem por aqui. Até lá desejamos que você tenha dias lindos e livres de preconceitos!";
			$mensagem->save();

			return Redirect::to('/configuracoes/mensagens');
		}

	}


}