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
					<li role="presentation"><a href="/configuracoes/perfil"><span class="glyphicon glyphicon-user"></span>  Perfil</a></li>
					@if (Auth::user()->tipo == 2)
					<li role="presentation" class="active"><a href="/configuracoes/historia"><span class="glyphicon glyphicon-comment"></span> História</a></li>
					@endif
					<li role="presentation" class=""><a href="/configuracoes/mensagens"><span class="glyphicon glyphicon-envelope"></span> Mensagens <span class="badge">{{$quantidadeMsg}}</span></a></li>
				</ul>
			</div>

			<br>
			
			@foreach ($historia as $historia)
			<div style="display:flex;" class="col-md-offset-2 col-lg-offset-2 col-md-4 col-lg-4 col-sm-12 col-xs-12 col-sm-12 portfolio-item">
				<a id="fotoDaHistoria" class="portfolio-link">
					<div class="caption caption-profile">
						<div class="caption-content">
							<h2 class="nexa-bold"><span class="glyphicon glyphicon-camera"></span> <br>
								Trocar Foto</h2>
							</div>
						</div>

						<img class="img-responsive perfil" src="/imagem/{{$historia->imagem}}">
					</a>

					{!!Form::open(array('url'=>'/configuracoes/atualizar-foto-historia', 'files'=>'true', 'id' => 'formHistoria')) !!}
					<input type="hidden" name="tipo" id="tipo"/>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="x" name="x" />
					<input type="hidden" id="y" name="y" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />

					<input type="file" id="files" name="imagem" onchange="fotoHistoria()" style="display:none;" />
				</form>
			</div>
			<input type="file" id="files" onchange="fotoHistoria()" style="display:none;" />
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 div-center">
				<b>Meta</b>: R${{$historia->meta}}
				<br>
				<b>Arrecadado:</b> R${{$historia->arrecadado}} 
			</br>
			<b>Objetivo:</b> {{$historia->finalidade}}
			<br>
			<div align="justify"><b>Descrição:</b> {{$historia->descricao}}</div>
			<br>
			<br>
			<a data-toggle="modal" data-target="#modalEditarHistoria" class="btn btn-sm btn-default">Editar</a>
			<a data-toggle="modal" data-target="#modalExcluirHistoria" class="btn btn-sm btn-danger">Excluir</a>
		</div>

		<br><br>
		<hr>
		<div class="col-md-offset-2 col-md-8">
			<h3>Saques </h3>
			@if (count($saques) > 0)
			
			<table class="table table-hover"> 
				<thead> 
					<tr> 
						<th>Data - Hora</th> 	
						<th>Valor</th> 
						<th>Dados</th> 
						<th>Banco</th> 
						<th>Status</th>
					</tr> 
				</thead> 
				<tbody> 
				@foreach ($saques as $saques)
					<tr> 
						<th scope="row">{{$saques->created_at}}</th> 
						<td>{{$saques->valor}}</td> 
						<td> {{$saques->agencia}} \ {{$saques->conta}} </td> 
						<td> {{$saques->banco}} </td> 
						<td> 
						@if ($saques->status == '1') 
							<span class="label label-default">Em análise</span>
						@elseif ($saques->status == '2')
							<span class="label label-success">Aprovado</span>
						@elseif ($saques->status == '3')
							<span class="label label-danger">Dados inválidos</span>
						@endif	

						</td>
					</tr> 
				@endforeach	
				</tbody> 
			</table>
			@else
			@endif
			<div class="alert alert-default" role="alert">
			@if (($historia->arrecadado > 0) && (($historia->arrecadado - $saquesAtendidosTotal) > 0))
				@if(!count($saquesRecebidos)>0)
					<p align="center" class="politica"> Disponível para saque: R${{floatval($historia->arrecadado - $saquesAtendidosTotal)}},00 <br><br><a  data-toggle="modal" data-target="#modalRealizarSaque" class="btn btn-info btn-md btn-saque">Solicitar saque</a>
					</p>
				@else
					<p align="center" class="politica">
						+ Existem saques pendentes! <br>
					</p>
				@endif
				
			@else 
				<p align="center" class="politica">+ Saldo insuficiente</p>
			@endif
			</div>
			</div>	
		</div>
		@include ('partials.modalCortarImagem')
		@include('partials.modalEditarHistoria')
		@include ('partials.modalExcluirHistoria')
		@include('partials.modalRealizarSaque')
		@endforeach
	</div>
</div>
</section>
@endsection

@section('script')
<script src="/js/jquery.Jcrop.min.js"></script>
<script src="/js/transcendaJcrop.js"></script>
@endsection