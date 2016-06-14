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
			<img class="img-responsive img-circle perfil" src="/imagem/{{$historia->imagem}}">
<h2 class="nome">{{$historia->autor->name}}</h2>
				<hr class="star-primary">
			</div>
</div>
<div class="row">
<div class="col-lg-12 text-center">
<h3>Meta: R$ {{floatval($historia->meta)}} <br> Arrecadado: R$ {{floatval($total)}},00</h3>
<h4>Finalidade: {{$historia->finalidade}}</h4>
<div class="progress">
  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="{{floatval($historia->meta)}}" style="width: {{$porcentagem}}%">
  </div>
</div>
</div>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<h4 class='center'>Mais sobre {{$historia->autor->name}}</h4>
<p class="descricao">{{$historia->descricao}}</p>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<h4 class='center'>Andamento das doacoes</h4>
@if ($grafico == null)

<div class="well"><h4 align="center">Ainda não houveram doações =(</h4></div>

@else
<div id="stocks-div"></div>
<?php 
echo Lava::render('LineChart', 'Stocks', 'stocks-div');
 ?>
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
@if (count($doacoes) > 0)
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
@else 
Não há doações. Por que você não ajuda? :)
@endif
</div>

<div class="row">
<h3>Comentários</h3>
<hr>

@if (count($comentarios) > 0)
@foreach ($comentarios as $comentario)
<div class="media">
  <div class="media-left">
     <img class="media-object img-circle" src="/imagem/{{$comentario->autor->imagem}}" alt="...">
   </div>
  <div class="media-body">
    <h4 class="media-heading">{{$comentario->autor->name}} 
	    @if (!Auth::guest())
	  	@if(Auth::user()->id == $comentario->autor->id)
	 		<a class="btn btn-danger btn-sm" href="/excluircomentario/{{$comentario->id}}"><span class="glyphicon glyphicon-trash"></span></a>
	  		<a class="btn btn-default btn-sm" onclick="editarComentario({{$comentario->id}});"><span class="glyphicon glyphicon-pencil"></span></a>
	  	@endif
	    @endif
    </h4>
 	<div id="comentario_{{$comentario->id}}" class="sera">
 		{{$comentario->conteudo}} <br>
	<span class="hora">	Publicado há {{tempoPostagem($comentario->created_at)}}</span>
 	</div>
 	 @if (!Auth::guest())
	 @if(Auth::user()->id == $comentario->autor->id)
	 <div id="editar_{{$comentario->id}}" style="display: none;">
	 	{!! Form::open (['method' => 'POST', 'route' => 'atualizar-comentario', $historia->id]) !!}
			<div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
				<input type="hidden" name="comentarioID" value="{{$comentario->id}}">
				<textarea name="comentario" class="form-control">{{$comentario->conteudo}}</textarea>
				<br><input type="submit" class="btn btn-default btn-sm" value="Atualizar">
			</div>
		</form>
	  </div>	
	 @endif
	 @endif
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
	<br>
	<input type="submit" class="btn btn-default" value="Comentar">
	@else
	<textarea class="form-control" name="comentario" disabled>Faça login para comentar!
	</textarea>
	<br>
	<input type="submit" class="btn btn-default" value="Comentar" disabled>
	@endif
</form>
</div>
</section>
@endsection
@if (!Auth::guest())
	@include('partials.modalDoar');
@endif

@section('script')
	<script src="/js/doacoes.js"></script>
@endsection
