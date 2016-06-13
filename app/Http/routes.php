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



//Historias
// Verifica se o usuário está logado
Route::group(['middleware' => 'auth'], function()
{
 Route::get('cadastrar-historia', 'HistoriasController@create');
 Route::get('configuracoes/perfil', ['as' => 'configuracoes', 'uses' => 'Auth\AuthController@configPerfil']);
 Route::post('configuracoes/perfil', ['as' => 'atualizar-perfil', 'uses' => 'Auth\AuthController@update']);
 Route::post('configuracoes/atualizar-senha', ['as' => 'atualizar-senha', 'uses' => 'Auth\AuthController@updatePassword']);
 Route::get('configuracoes/historia', 'HistoriasController@configHistoria');
 Route::get('configuracoes/mensagens', 'MensagensController@index');
 Route::get('configuracoes/mensagens/ler/{id}', 'MensagensController@ler');
 Route::get('configuracoes/mensagens/excluir/{id}', 'MensagensController@destroy');
});

//Doacoes 
Route::post('/configuracoes/sacar', 'DoacoesController@sacar');

//Gráficos
Route::get('/graficos/doacoes/{id}', 'HistoriasController@getDoacoes');

//PagSeguro
// Enviamos nuestro pedido a PayPal
Route::post('pagar', array(
	'as' => 'payment',
	'uses' => 'DoacoesController@postPayment',
));
// Después de realizar el pago Paypal redirecciona a esta ruta
Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'DoacoesController@getPaymentStatus',
));

Route::post('comentar', ['as' => 'comentar', 'uses' => 'HistoriasController@comentar']);

Route::get('excluircomentario/{id}', 'HistoriasController@excluirComentario');