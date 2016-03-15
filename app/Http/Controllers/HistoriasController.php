<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Historias;
use App\User;
use App\Estados;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class HistoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function teste($id_historia)
    {
        $historia = Historias::find($id_historia);
        return view('transcenda.historias.perfil', compact('historia'));
    }

    /**
     * Show the form for creating a new resource.
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
  

        $imagem = $request->file('imagem');
        $name= $imagem->getClientOriginalName();
        


        $usuario = new User();
        $usuario->name = $request->get('nome');
        $usuario->email = $request->get('email');
        $usuario->cpf = $request->get('cpf');
        $usuario->password = bcrypt($request->get('senha'));

        $usuario->save();

        $id = $usuario->id;

       
        $historia = new Historias();
        $historia->idUser = $id;
        $historia->nomeSocial = $request->get('nomeSocial');
        $historia->aniversario = $request->get('nascimento');
        $historia->endereco = $request->get('endereco');
        $historia->bairro = $request->get('bairro');
        $historia->cep = $request->get('cep');
        $historia->idEstado = $request->get('estado');
        $historia->idCidade = $request->get('cidade');
        $historia->meta = $request->get('meta');
        $historia->objetivo = $request->get('objetivo');
        $historia->descricao = $request->get('historia');
        $historia->imagem = $name;

        $historia->save();

        
        if($imagem->move(public_path().'/imagem/', $name)){
            return Redirect::to('jcrop')->with('imagem', $name);
        } else {
            return "Erro!";
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
        //
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

      public function getCidades($id_estado)
    {


        $estados = new Estados();

        $estado = $estados->find($id_estado);

        $cidades = $estado->cidades()->getQuery()->get(['id', 'nome']);
        
        return Response::json($cidades);
    }

}


