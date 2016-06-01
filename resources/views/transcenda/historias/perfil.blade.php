<?php 

 function tempoPostagem($data) {
 		$retorno = null;

        $diaH = date('d');
        $mesH = date('m');
        $anoH = date('Y');

        $horaH = date('H');
        $minH = date('i');
        $segH = date('s');

        $ano = date('Y', strtotime($data));
        $mes = date('m', strtotime($data));;
        $dia = date('d', strtotime($data));

        $hora = date('H', strtotime($data));
        $min = date('i', strtotime($data));
        $seg = date('s', strtotime($data));

        if ($anoH > $ano) {
                $retorno .= $anoH - $ano . ' anos atras';
        } 
        if ($mesH > $mes) {
                $retorno .= $mesH - $mes . ' meses atras';
        } 
        if ($diaH > $dia) {
                $retorno .= $diaH - $dia . ' dias atras';
        } 
        if ($horaH > $hora) {
            $retorno .= $horaH - $hora . ' horas atras, ';
            $retorno .= ($minH - $min)*(-1) . ' minutos e ';
            $retorno .= ($segH - $seg) *(-1) . ' segundos';
        }
        if ($retorno == null) {
        	$retorno .= "menos de uma hora atrás";
        }

        return $retorno;
    }


 ?>


@extends('layouts.layout')
@section('conteudo')
<section id="perfil">
<div class="container">
<div class="row">
	@if (Session::has('message'))
		<div class="alert alert-warning" role="alert">{{Session::get('message')}}</div>
	@endif
			<div class="col-lg-12 text-center">
			<img class="img-responsive perfil" src="/imagem/{{$historia->imagem}}">
<h2 class="nome">{{$historia->autor->name}}</h2>
				<hr class="star-primary">
			</div>
</div>
<div class="row">
<div class="col-lg-12 text-center">
<h3>Meta: R$ {{$historia->meta}} <br> Arrecadado: R$ {{floatval($total)}},00</h3>
<h4>Finalidade: {{$historia->finalidade}}</h4>
<div class="progress">
  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="{{$historia->meta}}" style="width: {{$porcentagem}}%">
  </div>
</div>
</div>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<h4 class='center'>Mais sobre {{$historia->autor->name}}</h4>
<p class="descricao">{{$historia->descricao}}</p>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
''
<h4 class='center'>Andamento das doacoes</h4>
aqui vai um grafico 
  @if (!Auth::guest())
  	@if(Auth::user()->id == $historia->autor->id)
  	editar
  	@endif
  @endif
</div>
</div>
<div class="row center">
@if (!Auth::guest())
	<a  data-toggle="modal" data-target="#modalDoar" class="btn btn-success">Realizar Doacao</a>
@else
	<a  href="/login" class="btn btn-success">Logar para doar</a>
@endif 
<a class="btn btn-success" href="http://www.facebook.com/share.php?u=www.projetotranscenda.com&t=Ajude {{$historia->nomeSocial}}" target="_blank">Compartilhar</a> </div>

</div>
<br>
<div class="row">
<h3>Ultimas Doações</h3>
<hr>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Data</th>
				<th>Nome</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; ?>
		@foreach ($doacoes as $doacao)
		@if($i != 3)
		<?php $i++; ?>
			<tr>
				<td>{{$doacao->created_at}}</td>
				<td>{{$doacao->doador->name}}</td>
				<td>R$ {{$doacao->valor}},00</td>
			</tr>
		@endif
		@endforeach 

		</tbody>
	</table>
</div>

<div class="row">
<h3>Comentários</h3>
<hr>

@if (count($comentarios) > 0)
@foreach ($comentarios as $comentario)
<div class="media">
  <div class="media-left">
     <img class="media-object" src="/imagem/{{$comentario->autor->imagem}}" alt="...">
   </div>
  <div class="media-body">
    <h4 class="media-heading">{{$comentario->autor->name}} 
	    @if (!Auth::guest())
	  	@if(Auth::user()->id == $comentario->autor->id)
	 		<a class="btn btn-danger btn-sm" href="/excluircomentario/{{$comentario->id}}"><span class="glyphicon glyphicon-trash"></span></a>
	  		<a class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
	  	@endif
	    @endif
    </h4>
 	{{$comentario->conteudo}} <br>
	<span class="hora">	Publicado há {{tempoPostagem($comentario->created_at)}}</span>
  </div>
</div>
@endforeach
@else 
Não há comentários nesta história! Seja o primeiro.
<br>
@endif
<br>
{!! Form::open (['method' => 'POST', 'route' => 'comentar', $historia->id]) !!}
{!! Form::hidden('id', $historia->id) !!}
	@if (!Auth::guest())
	<textarea class="form-control" name="comentario" placeholder="Escreva seu comentário!">
	</textarea>
	@else
	<textarea class="form-control" name="comentario" disabled>
	</textarea>
	@endif
	<br>
	<input type="submit" class="btn btn-default" value="Comentar">
</form>
</div>
</section>
@endsection
@if (!Auth::guest())
	@include('partials.modalDoar');
@endif
