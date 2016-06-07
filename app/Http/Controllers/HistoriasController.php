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
            $name = date('dmyhis').$imagem->getClientOriginalName();
            $quality = 90;

            if($imagem->move(public_path().'/imagem/', $name)){
            $src  = public_path().'/imagem/'.$name;
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
        }

        } else {
            $name = '0';
        }

        
        $historia = new Historias();
        $historia->idUser = $request->get('idUser');
        $historia->meta = $request->get('meta');
        $historia->finalidade = $request->get('objetivo');
        $historia->descricao = $request->get('historia');
        $historia->imagem = $name;
        
        if ($historia->save()) {  
            $this->setTipo($historia->idUser);
         return Redirect::route('historia', $historia->id);
        }
}

    public function imagem() {

    
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

        return view('transcenda.historias.historia', array('historia'=>Historias::find($id), 'doacoes'=>Doacoes::where('idHistoria', $id)->orderBy('created_at', 'dsc')->get(), 'total' => Doacoes::where('idHistoria', $id)->sum('valor'), 'porcentagem' => $this->porcentagem($id), 'falta' => $this->quantoFalta($id),'comentarios' => $comentarios));
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

    public function updatePicture(Request $request) {

        if(Input::get('tipo') == '1') {
        if (Input::file('imagem')) {
            $imagem = $request->file('imagem');
            $name = date('dmyhis').$imagem->getClientOriginalName();
            $quality = 90;

            if($imagem->move(public_path().'/imagem/', $name)){
            $src  = public_path().'/imagem/'.$name;
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

             if (\DB::table('historias')->where('idUser', Auth::user()->id)->update(array('imagem' => $name)))
            {
                return Redirect::back()->with('message', 'Imagem  atualizada com sucesso!');
             }

        }
    } else {
        return Redirect::back()->with('message', 'Deu erro!');
    }
    } else {
        if (Input::file('imagem')) {
            $imagem = $request->file('imagem');
            $name = date('dmyhis').$imagem->getClientOriginalName();
            $quality = 90;

            if($imagem->move(public_path().'/imagem/', $name)){
            $src  = public_path().'/imagem/'.$name;
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

             if (\DB::table('users')->where('id', Auth::user()->id)->update(array('imagem' => $name)))
            {
                return Redirect::back()->with('message', 'Imagem  atualizada com sucesso!');
             }

        }
    } else {
        return Redirect::back()->with('message', 'Deu erro!');
    }
    }
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        if (\DB::table('historias')->where('idUser', Auth::user()->id)->update(array('finalidade' => Input::get('objetivo'), 'descricao' => Input::get('historia'), 'meta' => Input::get('meta'))))
            {
                return Redirect::back()->with('message', 'História atualizada com sucesso!');
             }

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


