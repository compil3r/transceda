@extends('layouts.layout')
@section('head')
<link rel="stylesheet" href="/css/jquery.Jcrop.min.css" />
@endsection
@section('conteudo')
<section id="perfil">
	<div class="container">
		@if (Session::has('message'))
		<div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
		@endif
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Lista de Saques</h2>
				<hr class="star-primary">
			</div>
		</div>

		<div class="row">
			<div class="menu-horizontal col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">
				<ul class="nav nav-tabs nav-justified">
					<li role="presentation"><a href="/saques/pendentes"><span class="glyphicon glyphicon-question-sign"> </span> Pendentes</a></li>
					<li role="presentation" class="active"><a href="/saques/aprovados"><span class="glyphicon glyphicon-ok-sign"></span> Resolvidos</a></li>
					<li role="presentation" class=""><a href="/saques/recusados"><span class="glyphicon glyphicon-remove-sign"></span>  Problemáticos</a></li>
				</ul>
			</div>
			<br>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if (count($saques) > 0)

				<table class="table table-hover"> 
					<thead> 
						<tr> 
							<th>Data - Hora</th> 	
							<th>Titular</th>
							<th>Valor</th> 
							<th>Agencia</th> 
							<th>Conta</th>
							<th>Operação</th>
							<th>Banco</th> 
						</tr> 
					</thead> 
					<tbody> 
						@foreach ($saques as $saques)
						<tr> 
							<th scope="row">{{$saques->created_at}}</th> 
							<td>{{$saques->titular}}</td>
							<td>{{$saques->valor}}</td> 
							<td>{{$saques->agencia}} </td>
							<td>{{$saques->conta}} </td> 
							<td>{{$saques->banco}} </td> 
							<td>{{$saques->operacao}}</td>
						</tr> 
						@endforeach	
					</tbody> 
				</table>
				@else
				<div class="col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">	
					<div class="alert alert-default" role="alert">
						<p align="center" class="politica"> Não há saques aprovados. </p>
					</div>
				</div>
				@endif
			</div>
		</div>
	</section>
	@endsection

	@section('script')
	<script src="/js/jquery.Jcrop.min.js"></script>
	<script src="/js/transcendaJcrop.js"></script>
	@endsection