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
				<li role="presentation" class="active"><a href="#">Perfil</a></li>
				@if (Auth::user()->tipo == 2)
					<li role="presentation"><a href="/configuracoes/historia">História</a></li>
				@endif
				<li role="presentation" class=""><a href="/configuracoes/mensagens">Mensagens <span class="badge">{{$quantidadeMsg}}</span></a></li>
			</ul>
			</div>
			@include ('partials.modalCortarImagem')
			<br>

			<div class="col-md-offset-2 col-lg-offset-2 col-sm-offset-2 col-xs-offset-2 col-md-4 col-lg-4 col-sm-4 col-xs-4 col-sm-6 portfolio-item">
				<a id="fotoDePerfil" class="portfolio-link">
					<div class="caption caption-profile">
						<div class="caption-content">
							<h2 class="nexa-bold"><span class="glyphicon glyphicon-camera"></span> <br>
								Trocar Foto</h2>
							</div>
						</div>


						<img class="img-responsive perfil" src="/imagem/{{Auth::user()->imagem}}">
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
				<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
					Nome: {{Auth::user()->name}}
					<br>
					Nascimento: {{Auth::user()->aniversario}}
					<br>
					Endereco: {{Auth::user()->cidade->nome}} - {{Auth::user()->cidade->estado->uf}}
					<br>
					Email: {{Auth::user()->email}}
					<br>
					CPF: {{Auth::user()->cpf}}

					<br><br>
					<a data-toggle="modal" data-target="#modalEditarPerfil" class="btn btn-sm btn-default">Editar</a>
					<a data-toggle="modal" data-target="#modalEditarSenha" class="btn btn-sm btn-default">Editar Senha</a>
					<a data-toggle="modal" data-target="#modalExcluirHistoria" class="btn btn-sm btn-danger">Desativar</a>
				</div>
			</div>
			@include ('partials.modalEditarPerfil')
			@include ('partials.modalEditarSenha')
		</div>
	</div>
</section>
@endsection

@section('script')
<script src="/js/jquery.Jcrop.min.js"></script>
<script src="/js/transcendaJcrop.js"></script>
@endsection