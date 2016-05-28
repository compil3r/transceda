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
<h3>Meta: R$ {{$historia->meta}}</h3>
@foreach ($doacoes as $doacao)
	sera
@endforeach
<h4>Finalidade: {{$historia->finalidade}}</h4>
</div>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<h4 class='center'>Mais sobre {{$historia->autor->name}}</h4>
<p class="descricao">{{$historia->descricao}}</p>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

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
</section>
@endsection
@if (!Auth::guest())
	@include('partials.modalDoar');
@endif