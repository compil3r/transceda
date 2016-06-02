<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Historias;
use App\User;
use App\Estados;
use App\Doacoes;
use App\Comentarios;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HistoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        /**
     * Get a validator for an incoming registration request.
    *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            return view('transcenda.historias.cadastrar', array('estados'=>Estados::all()));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'idUser' => 'required|unique:historias',
  
        ]);

          if ($validator->fails()) {
             return Redirect::to('cadastrar-historia')->withErrors($validator)->with('message', 'oi');
        }
        if (Input::file('imagem')) {
            $imagem = $request->file('imagem');
            $name= $imagem->getClientOriginalName();
        } else {
            $name = '0';
        }

        
        $historia = new Historias();
        $historia->idUser = $request->get('idUser');
        $historia->meta = $request->get('meta');
        $historia->finalidade = $request->get('objetivo');
        $historia->descricao = $request->get('historia');
        $historia->imagem = $name;
        $historia->save();

        $this->setTipo($historia->idUser);

        if (Input::file('imagem')) {  
             if($imagem->move(public_path().'/imagem/', $name)){
                return Redirect::to('jcrop')->with('imagem', $name);
            }
        } else {
            return Redirect::to('home');
        }
}

    public function imagem() {

    $quality = 90;

    $src  = Input::get('imagem');
    if (File::extension($src)=='jpeg' || File::extension($src)=='jpg'){
        $img  = imagecreatefromjpeg($src);
    } else if (File::extension($src) == 'png'){
        $img = imagecreatefrompng($src);
    } else if (File::extension($src) == 'gif') {
        $img = imagecreatefromgif($src);
    } 
    
    $dest = ImageCreateTrueColor(Input::get('w'),
        Input::get('h'));

    imagecopyresampled($dest, $img, 0, 0, Input::get('x'),
        Input::get('y'), Input::get('w'), Input::get('h'),
        Input::get('w'), Input::get('h'));
    imagejpeg($dest, $src, $quality);

    return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comentarios = Comentarios::where('idHistoria', $id)->orderBy('created_at', 'asc')->get();

        return view('transcenda.historias.perfil', array('historia'=>Historias::find($id), 'doacoes'=>Doacoes::where('idHistoria', $id)->orderBy('created_at', 'dsc')->get(), 'total' => Doacoes::where('idHistoria', $id)->sum('valor'), 'porcentagem' => $this->porcentagem($id), 'falta' => $this->quantoFalta($id),'comentarios' => $comentarios));
    }

    private function porcentagem($id) {
         $arrecadado = Doacoes::where('idHistoria', $id)->sum('valor');
         $total = Historias::find($id)->meta;

         $porcentagem = ($arrecadado*100)/$total;

         return $porcentagem;

    }


    private function quantoFalta($id) {
         $arrecadado = Doacoes::where('idHistoria', $id)->sum('valor');
         $total = Historias::find($id)->meta;

         $falta = $total - $arrecadado;

         return $falta;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function setTipo($idUser) {
        \DB::table('users')->where('id', $idUser)->update(array('tipo' => 2));
    }

      public function getCidades($id_estado)
    {


        $estados = new Estados();

        $estado = $estados->find($id_estado);

        $cidades = $estado->cidades()->getQuery()->get(['id', 'nome']);
        
        return Response::json($cidades);
    }

    public function comentar(){

        $comentario = new Comentarios();
        $comentario->idUsuario = Auth::user()->id;
        $comentario->idHistoria = Input::get('id');
        $comentario->conteudo = Input::get('comentario');

        $comentario->save();
        return Redirect::back()->with('message', 'Comentário realizado!');
    }


    public function excluirComentario($id){
        $comentario = Comentarios::find($id);
        $comentario->delete();

        return Redirect::back()->with('message', 'Comentário excluido!');
    }

}


