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
				<h2>Central do Usuário</h2>
				<hr class="star-primary">
				Bem vindo a seção de configurações. Aqui você pode editar e excluir o seu perfil, bem como editar e excluir a sua história (se houver).
			</div>
		</div>

		<div class="row">
			<div class="menu-horizontal col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">
				<ul class="nav nav-tabs nav-justified">
					<li role="presentation"><a href="/configuracoes/perfil"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
					@if (Auth::user()->tipo == 2)
					<li role="presentation"><a href="/configuracoes/historia"><span class="glyphicon glyphicon-comment"></span> História</a></li>
					@endif
					<li role="presentation" class="active"><a href="/configuracoes/mensagens"><span class="glyphicon glyphicon-envelope"></span> Mensagens <span class="badge">{{$quantidadeMsg}}</span></a></li>
				</ul>
			</div>
			
			<br>
		</div>
		<div class="row">
			<?php $i = 0;
			$j = 0; ?>
			@if(count($mensagens) > 0)
			@foreach($mensagens as $mensagem)
			@if ($mensagem->status == 1)
			@if ($i == 0)
			<div class="col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">	
			<h3>Não lidas</h3>
			</div>
			@endif
			<?php $i = 1; ?>
			<div class="col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">	

				<div class="panel panel-info">
					<div class="panel-heading">Assunto: {{$mensagem->assunto}}</div>
					<div class="panel-body">
						<p align="center" class="mensagens">{{$mensagem->mensagem}}</p>

						<p align="center" class="mensagens"><a href="/configuracoes/mensagens/ler/{{$mensagem->id}}" class="btn btn-info btn-sm">Marcar como lida</a></p>
					</div>
				</div>
			</div>
			@endif
			@endforeach
			@foreach($mensagens as $mensagens)
			@if ($mensagens->status == 2)
			@if ($j == 0)
			<div class="col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">	
				<h3>Lidas</h3>
			</div>
			@endif
			<?php $j = 1; ?>
			<div class="col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">	
				<div class="panel panel-default">
					<div class="panel-heading">Assunto: {{$mensagens->assunto}}</div>
					<div class="panel-body">
						<p align="center" class="mensagens">{{htmlspecialchars_decode($mensagens->mensagem)}}</p>

						<p align="center" class="mensagens"><a href='/configuracoes/mensagens/excluir/{{$mensagens->id}}' class="btn btn-default btn-sm">Excluir</a></p>
					</div>
				</div>
			</div>
			@endif
			@endforeach
			@else
			<div class="col-md-offset-2 col-xs-offset-2  col-sm-offset-2  col-lg-offset-2 col-md-8 col-xs-8 col-sm-8 col-lg-8">	
			<div class="alert alert-default" role="alert">
					<p align="center" class="politica"> Não há mensagens </p>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
</div>
</section>
@endsection

@section('script')
<script src="/js/jquery.Jcrop.min.js"></script>
<script src="/js/transcendaJcrop.js"></script>
@endsection