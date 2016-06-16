<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mensagens;
use App\Estados;
use App\Historias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MensagensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

          if (!Auth::guest()) {
            $mensagensT = Mensagens::where('idRecebedor', Auth::user()->id)->where('status', 1)->count();
        } else {
            $mensagensT = 0;
        }
        $quantidadeMsg = Mensagens::where('idRecebedor', Auth::user()->id)->where('status', 1)->count();
        $mensagens = Mensagens::where('idRecebedor', Auth::user()->id)->orderBy('created_at', 'asc')->get();

        return view('configuracoes.mensagens', array('mensagens' => $mensagens, 'quantidadeMsg' => $quantidadeMsg, 'mensagensT' => $mensagensT));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function ler($id){

        if (\DB::table('mensagens')->where('id', $id)->update(array('status' => 2)))
            {
                return Redirect::back();
             }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $mensagem = Mensagens::find($id);
        $mensagem->delete();

        return Redirect::back();
    }
}
