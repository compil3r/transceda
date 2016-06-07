@extends('layouts.layout')
@section('css')
<link rel="stylesheet" href="/css/jquery.Jcrop.min.css" />
@endsection
@section('conteudo')
<section id="perfil">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Configurações</h2>
				<hr class="star-primary">
				Bem vindo a seção de configurações. Aqui você pode editar e excluir o seu perfil, bem como editar e excluir a sua história (se houver).
			</div>
		</div>

		<div class="row">
			<br>
			@if (Auth::user()->tipo == 2)
			<p align="center"><a class="btn btn-primary teste" role="button" data-parent="acorddion" data-toggle="collapse" href="#collapseExample" aria-expanded="false" data-toggle="collapse" aria-controls="collapseExample">
				Configurar História
			</a>
			<button class="btn btn-primary teste" type="button" data-toggle="collapse" data-parent="acorddion" href="#teste" data-target="#teste" aria-expanded="true" aria-controls="teste">
				Configurar Conta de Usuário
			</button>
		</p>
		@foreach ($historia as $historia)
		<div class="collapse" id="collapseExample">
		<hr>


				<div class="col-md-offset-2 col-lg-offset-2 col-sm-offset-2 col-xs-offset-2 col-md-4 col-lg-4 col-sm-4 col-xs-4 col-sm-6 portfolio-item">
                    <a id="fotoDePerfil" class="portfolio-link">
                        <div class="caption caption-profile">
                            <div class="caption-content">
                                <h2 class="nexa-bold"><span class="glyphicon glyphicon-camera"></span> <br>
                                Trocar Foto</h2>
                            </div>
                        </div>


                        <img class="img-responsive perfil" src="/imagem/{{$historia->imagem}}">
                    </a>

                    {!!Form::open(array('url'=>'/configuracoes/atualizar-foto-historia', 'files'=>'true', 'id' => 'formHistoria')) !!}

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />

                    <input type="file" id="files" name="imagem" onchange="fotoHistoria()" style="display:none;" />
                </form>
                </div>
                <input type="file" id="files" onchange="fotoHistoria()" style="display:none;" />
				<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
				Meta: {{$historia->meta}}
				<br>
				Objetivo: {{$historia->finalidade}}
				<br>
				Descrição: {{$historia->descricao}}
				<br><br>
				<a data-toggle="modal" data-target="#modalEditarHistoria" class="btn btn-sm btn-default">Editar</a>
				<a data-toggle="modal" data-target="#modalExcluirHistoria" class="btn btn-sm btn-danger">Excluir</a>
				</div>
		</div>
			@include ('partials.modalCortarImagem')
			@include('partials.modalEditarHistoria')
			@include ('partials.modalExcluirHistoria')
		@endforeach
		<div class="collapse" id="teste">
			<div class="well">
				p
			</div>
		</div>
		@else
		Usuario
		@endif
	</div>
</div>
</section>
@endsection

@section('script')
<script src="/js/jquery.Jcrop.min.js"></script>
@endsection