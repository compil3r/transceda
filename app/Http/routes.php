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

Route::get('/', 'TranscedaController@index');
Route::get('cadastrar-historia', 'HistoriasController@create' );
Route::post('/enviar', 'HistoriasController@store' );
Route::get('jcrop', function()
{
    return View::make('jcrop')->with('imagem', 'imagem/'. Session::get('imagem'));
});

Route::post('jcrop', 'HistoriasController@imagem');
Route::get('/cidades/{id_estado}', 'HistoriasController@getCidades');

Route::get('perfil/{id_historia}', 'HistoriasController@teste');