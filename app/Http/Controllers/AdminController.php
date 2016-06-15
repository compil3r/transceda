<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saques;
use App\Mensagens;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPendentes()
    {
        if (Auth::user()->tipo == 3) {
        $saques = Saques::where('status', 1)->get();
        return view('configuracoes.pendentes', array('saques' => $saques));
        } else {
        return redirect('/');
        }
    }

    public function getAprovados()
    {
        if (Auth::user()->tipo == 3) {
        $saques = Saques::where('status', 2)->get();
        return view('configuracoes.aprovados', array('saques' => $saques));
        } else {
        return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aprovaSaque($id)
    {
        if (Saques::where('id', $id)->update(array('status' => 2))) {
            $mensagem = new Mensagens();
            $mensagem->assunto = "Saque aprovado";
            $mensagem->idRecebedor = Saques::find($id)->historia->autor->id;
            $mensagem->status = 1;
            $valor = Saques::find($id)->valor;
            $data = Saques::find($id)->created_at;
            $mensagem->mensagem = "Olá! Sua solicitação de saque, no valor de R$ $valor reais, feita dia $data, foi autorizada. Aguarde até dois uteis para conferir a conta que nos passou. Qualquer problema entre em contato conosco. Beijos de luz!";
            $mensagem->save();

            return Redirect::back();
        }
    }

    public function recusarSaque($id)
    {
        if (Saques::where('id', $id)->update(array('status' => 3))) {
            $mensagem = new Mensagens();
            $mensagem->assunto = "Saque recusado";
            $mensagem->idRecebedor = Saques::find($id)->historia->autor->id;
            $mensagem->status = 1;
            $valor = Saques::find($id)->valor;
            $data = Saques::find($id)->created_at;
            $mensagem->mensagem = "Olá! Sua solicitação de saque, no valor de R$ $valor reais, feita dia $data, teve probelmas. Acreditamos que a conta que nos informou apresentou problemas. Solicitamos que refaça a solicitação, e em caso de persistência do erro que nos envie uma novaa conta! Desculpinhas pelo problema. Beijos de luz!";
            $mensagem->save();

            return Redirect::back();
        }
    }

    public function getRecusados() {

        if (Auth::user()->tipo == 3) {
        $saques = Saques::where('status', 3)->get();
        return view('configuracoes.recusados', array('saques' => $saques));
        } else {
        return redirect('/');
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
        //
    }
}
