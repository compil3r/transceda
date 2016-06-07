 <?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/ 

use Illuminate\Support\Facades\Mail;

Route::get('/home', 'TranscedaController@index');
Route::get('/', 'TranscedaController@index');
Route::post('/enviar', 'HistoriasController@store' );
Route::get('jcrop', function()
{
    return View::make('jcrop')->with('imagem', 'imagem/'. Session::get('imagem'));
});

Route::post('jcrop', 'HistoriasController@imagem');
Route::get('/cidades/{id_estado}', 'HistoriasController@getCidades');

Route::get('historia/{id_historia}', ['as' => 'historia', 'uses' => 'HistoriasController@show']);
Route::post('configuracoes/atualizar-historia', ['as' => 'atualizar-historia', 'uses' => 'HistoriasController@update']);
Route::post('configuracoes/atualizar-foto-historia', ['as' => 'atualizar-foto-historia', 'uses' => 'HistoriasController@updatePicture']);

// Users - Login e Logout routes...
Route::get('login', ['as' =>'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', 'Auth\AuthController@getLogout');

// User - Registration routes...
Route::get('register', ['as' =>'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' =>'register', 'uses' => 'Auth\AuthController@postRegister']);

// Users - Password reset link request routes...
Route::get('esqueci-minha-senha', ['as' =>'password/email', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('esqueci-minha-senha', ['as' =>'password/email', 'uses' => 'Auth\PasswordController@postEmail']);

// Users - Password reset routes...
Route::get('senha/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('senha/reset', 'Auth\PasswordController@postReset');

//Users - Show, edit and delete routes...
Route::post('configuracoes/atualizar-perfil', ['as' => 'atualizar-perfil', 'uses' => 'Auth\AuthController@update']);
Route::post('configuracoes/atualizar-senha', ['as' => 'atualizar-senha', 'uses' => 'Auth\AuthController@updatePassword']);
// Verifica se o usuário está logado
Route::group(['middleware' => 'auth'], function()
{
 Route::get('cadastrar-historia', 'HistoriasController@create');
 Route::get('perfil/configuracoes', ['as' => 'configuracoes', 'uses' => 'Auth\AuthController@show']);

});


//PagSeguro

// Enviamos nuestro pedido a PayPal
Route::post('pagar', array(
	'as' => 'payment',
	'uses' => 'PaypalController@postPayment',
));
// Después de realizar el pago Paypal redirecciona a esta ruta
Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus',
));

Route::post('comentar', ['as' => 'comentar', 'uses' => 'HistoriasController@comentar']);

Route::get('excluircomentario/{id}', 'HistoriasController@excluirComentario');