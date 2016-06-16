@extends('layouts.layout')
@section('css')
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" />
@endsection
@section('conteudo')
<section id="contar">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Histórias</h2>
				<hr class="star-primary">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
			@foreach($historias as $historia)
				<div class="media">
					<div class="media-left">
						<a href="/historia/{{$historia->id}}">
							<img class="media-object img-circle" style="width: 90px; height: 90px;" src="/imagem/{{$historia->imagem}}" alt="...">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">@foreach($users as $user)
						@if ($user->id  == $historia->idUser)
						{{$user->name}} | {{$historia->finalidade}} 
						@endif
						@endforeach</h4>
						{{substr($historia->descricao, 0, 250)}} <br> <a href="/historia/{{$historia->id}}" class="btn btn-xs btn-default">Ver mais</a>
					</div>
				</div>
			@endforeach
			<br>
			<br>
			<p style="display:flex; justify-content: center;">{!! $historias->render() !!}</p>
			</div>
		</div>

	</section>

	@endsection

	@section('jquery')
	<script src="/js/jquery.mask.min.js"></script>
	<script src="js/mascaras.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
	@endsection

	@section('script')
	<script src="/js/transcendaJcrop.js"></script>
	@endsection