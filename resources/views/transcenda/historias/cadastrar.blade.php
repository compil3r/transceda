@extends('layouts.layout')
@section('css')
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" />
@endsection
@section('conteudo')
<section id="contar">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Conte sua história</h2>
				<hr class="star-primary">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if ($errors->has('idUser'))
				<div class="alert alert-info">
				<p align="center">Você já possui uma história cadastrada! Para acessa-la vá para painel de controle.</p>
				
				</div>
				@endif

					@if (Auth::user()->tipo == 2)
					<div class="alert alert-danger">
					<p align="justify" class="politica">Ops... Infelizmente a nossa politica hoje não permite que você cadastre mais de uma historia por CPF. </p><p align="justify" class="politica"> Isso acontece por que acreditamos que, além da importância do empoderamento pessoal para que a história seja cadastrada é importante que todos/todas tenham a chance de realizar o cadastro.
					Em breve será possivel cadastrar a história de terceiros, mas enquanto estamos começando esse trabalho é importante que cada um faça por si proprio.
					</p>
					<p align="justify" class="politica">A sua história pode ser acessada pelo link: 
					</p>
				
					</div>
					@endif
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
				<!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->

				{!!Form::open(array('url'=>'/enviar', 'files'=>'true')) !!}
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" id="x" name="x" />
        		<input type="hidden" id="y" name="y" />
        		<input type="hidden" id="w" name="w" />
        		<input type="hidden" id="h" name="h" />
				<div class="row control-group">
					<div class="form-group col-xs-12">	
						<span class="btn btn-md btn-block btn-default fileinput-button">
							<span>Adicionar uma foto a história</span>
							<input type="file" name="imagem" id="files" onchange="fileSelectHandler()">
						</span>
						<output id="list"></output>
					</div>
				</div>

		

		<div class="modal fade" id="modal1">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Cortar Imagem</h4>
					</div>
					<div class="modal-body">
				<img id="preview" class="img-responsive"/>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cortar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


				<input type="hidden" name="idUser" value="{{Auth::user()->id}}">
				<div class="row control-group">
					<div class="form-group col-xs-6">
						<label>Meta: (R$)</label>
						<input onKeyUp="maskIt(this,event,'### ### ###.##',true)" type="text" id="meta" class="form-control" name="meta" placeholder="R$ 0,00" required data-validation-required-message="Por favor, entre com sua meta" >
						<p class="help-block text-danger"></p>
					</div>

					<div class="form-group col-xs-6">
						<label>Finalidade:</label>
						<input type="text" id="objetivo" class="form-control" name="objetivo" placeholder="Objetivo" required data-validation-required-message="Por favor, entre com seu objetivo">
						<p class="help-block text-danger"></p>							
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12">
						<label>Sua história</label>
						<textarea placeholder="Conte sua história com mais detalhes!" class="form-control" name="historia" id="historia"></textarea>
						<span id="msg"></span>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 ">
						<input class="form" type="checkbox" name="termos" valeu="sim" > Eu li e concordo com os <a  type="button" data-toggle="modal" data-target="#myModal">termos de condicoes e privacidade</a>
					</div>
				</div>
				<br>
				<div class="row control-group">
					<div class="form-group col-xs-12">
					@if (Auth::user()->tipo == 1)
						<input type="submit" value="Publicar História" class="btn btn-lg btn-success btn-block"></input>
					@else 
						<input type="submit" value="Publicar História" class="btn btn-lg btn-default btn-block" disabled></input>
					@endif
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@include('partials.termos');

</section>

@endsection

@section('jquery')
<script src="/js/jquery.mask.min.js"></script>
<script src="js/jquery.Jcrop.min.js"></script>
@endsection

@section('script')

<script type="text/javascript">
	$('select[name=estado]').change(function () {
		var id_estado = $(this).val();

		$('select[name=cidade]').html('').append('<option value="">  Carregando...  </option>');
		$.get('/cidades/' + id_estado, function (cidades) {
			$('select[name=cidade]').empty();
			$.each(cidades, function (key, value) {
				$('select[name=cidade]').append('<option value=' + value.id + '>' + value.nome + '</option>');
			});
		});
	});
</script>
@endsection