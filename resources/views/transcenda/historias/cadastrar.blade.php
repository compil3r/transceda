@extends('layouts.layout')
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
			<div class="col-lg-8 col-lg-offset-2">
				<!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
				<!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->

				{!!Form::open(array('url'=>'/enviar', 'files'=>'true')) !!}
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Nome Completo:</label>
						<input type="text" class="form-control" placeholder="Nome Completo*" id="nome" name="nome" required data-validation-required-message="Por favor, entre com o seu nome!">
						*Este dado será mantido em sigilo!
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Nome social:</label>
						<input type="text" class="form-control" placeholder="Nome Social" id="nomeSocial" name="nomeSocial" required data-validation-required-message="Por favor, entre com o seu nome social!">
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Email:</label>
						<input type="email" class="form-control" placeholder="Email" id="email" name="email" required data-validation-required-message="Por favor, entre com o seu email!">
						<p class="help-block text-danger"></p>
					</div>
				</div>	
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>CPF:</label>
						<input  type="text" class="form-control" placeholder="CPF (Somente Números)" id="cpf" name="cpf" required data-validation-required-message="Por favor, entre com o seu email!">
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="row control-group"	>
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Data de Nascimento</label>
						<input pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" title="01/01/1999" type="text" class="form-control" placeholder="Data de Nascimento (dd/mm/aaaa)" id="nascimento" name="nascimento" required data-validation-required-message="Por favor, entre com sua data de nascimento!" data-validation-pattern-message="Formato correto: 01/01/1999">
						<p class="help-block text-danger"></p>							
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Endereço:</label>
						<input type="text" id="endereco" class="form-control" name="endereco" placeholder="Endereço" required data-validation-required-message="Por favor, entre com seu endereço">
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-6 floating-label-form-group controls">
						<label>Bairro:</label>
						<input type="text" id="bairro" class="form-control" name="bairro" placeholder="Bairro" required data-validation-required-message="Por favor, entre com seu bairro">
						<p class="help-block text-danger"></p>
					</div>
					<div class="form-group col-xs-6 floating-label-form-group controls">
						<label>CEP:</label>
						<input type="text" id="cep" class="form-control" name="cep" placeholder="CEP" required data-validation-required-message="Por favor, entre com seu estado">
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-6 floating-label-form-group controls">
						<label>Estado:</label>
						<select name="estado" class="form-control" size="1" placeholder="Teste">
							<option value="">Estado </option>
							@foreach ($estados as $estados)
							<option value="{{$estados->id}}">{{$estados->uf}}</option>
							@endforeach
						</select>
						<p class="help-block text-danger"></p>
					</div>
					<div class="form-group col-xs-6 floating-label-form-group controls">
						<label>Cidade</label>
						<select name="cidade" class="form-control" size="1" placeholder="Teste">
						<option value="">Cidades</option>

						</select>
						<p class="help-block text-danger"></p>
					</div>

				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<div class="ft">
							<span class="foto">Foto de perfil:</span>
							<span class="btn btn-default fileinput-button">
								<span>Selecionar</span>
								<input type="file" name="imagem" id="files">
							</span>
							<output id="list"></output>
						</div>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-sm-6 col-xs-12 floating-label-form-group controls">
						<label>Senha:</label>
						<input type="password" class="form-control" placeholder="Senha" id="senha" name="senha" required data-validation-required-message="Por favor, escolha uma senha.">
						<p class="help-block text-danger"></p>
						Minimo: 6 Caracteres
					</div>
					<div class="form-group col-sm-6 col-xs-12 floating-label-form-group controls">
						<label>Confirme a senha:</label>
						<input type="password" class="form-control" placeholder="Confirme a senha" id="confirme" name="confirme" required data-validation-required-message="Por favor, escolha uma senha.">
						<p id="s" class="help-block text-danger"></p>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-6 floating-label-form-group controls">
						<label>Meta:</label>
						<input onKeyUp="maskIt(this,event,'### ### ###.##',true)" type="text" id="meta" class="form-control" name="meta" placeholder="Meta (R$)" required data-validation-required-message="Por favor, entre com sua meta" >
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Objetivo:</label>
						<input type="text" id="objetivo" class="form-control" name="objetivo" placeholder="Objetivo" required data-validation-required-message="Por favor, entre com seu objetivo">
						<p class="help-block text-danger"></p>							
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
						<label>Sua história</label>
						<textarea placeholder="Sua história" class="form-control" name="historia" id="historia"></textarea>
						<span id="msg"></span>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12 floating-label-form-group controls">
					<input class="form" type="checkbox" name="termos" valeu="sim" > Eu li e concordo com os <button class="btn btn-default btn-sm" type="button" data-toggle="modal" data-target="#myModal">termos de condicoes e privacidade</button>
					</div>
				</div>
				<div class="row control-group">
					<div class="form-group col-xs-12">
						<input type="submit" value="Publicar História" class="btn btn-lg btn-success btn-block"></input>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Termos de condicoes e privacidade</h4>
      </div>
      <div class="modal-body">
		<p class="termo">Ao utilizar e participar de forma ativa no Transcenda, de qualquer das formas que o website permite, o Utilizador declara ter lido e aceitar cumprir os presentes Termos E Condições. O Transcenda reserva-se o direito – mas não a obrigação – de, perante o não cumprimento destes Termos e Condições, eliminar todo e qualquer conteúdo que os infrinja, bem como restringir e/ou bloquear o acesso do Utilizador infractor à participação no website, sem qualquer aviso prévio. </p>

		<p class="termo">Na utilização que fizer deste website (incluindo na submissão, envio ou publicação de conteúdos que fizer para o Transcenda), o Utilizador está obrigado e declara aceitar e cumprir a legislação aplicável, e concretamente o Código do Direito de Autor e dos Direitos Conexos, o Código da Propriedade Industrial e a Lei da Criminalidade Informática. </p>

		<p class="termo">O Utilizador está também obrigado a e declara agir de boa-fé e a fazer uma utilização do Transcenda que não ofenda quaisquer direitos de terceiros. Particularmente, compromete-se a não submeter qualquer conteúdo ou fazer uma participação que constitua qualquer ataque em função da raça, nacionalidade, origem étnica, religião, convicção política ou sexo; que constitua difamação, incitação ao furto, fraude, violência, terrorismo, sadismo, prostituição, pedofilia, bem como que empregue conteúdos de carácter obsceno, indecoroso ou pornográfico. </p>

		<p class="termo">O Utilizador apenas está autorizado a fazer uso dos conteúdos presentes no Transcenda para fins estritamente pessoais, sendo-lhe expressamente proibido publicar, reproduzir, difundir, distribuir ou, por qualquer outra forma, tornar os conteúdos acessíveis a terceiros, para fins de comunicação pública ou de comercialização, como por exemplo colocando-os disponíveis noutro site, serviço on-line ou em cópias de papel. Está igualmente vedada qualquer transformação dos conteúdos. </p>

		<p class="termo">É também expressamente proibido ao Utilizador criar ou introduzir no Transcenda tipos de vírus ou programas que o danifiquem, directa ou indirectamente. </p>

		<p class="termo">O Transcenda, e o respectivo conteúdo, tem finalidade exclusivamente lúdica, pelo que nada neste website constitui um conselho, não dispensando o conselho profissional, nem estabelece qualquer relação contratual. </p>

		<p class="termo">O Transcenda não é responsável por qualquer eventual perda ou danos, directos ou indirectos, sofridos por qualquer utilizador relativamente à informação contida neste site. </p>

		<p class="termo">O Utilizador é o único responsável pelos prejuízos, directos ou indirectos, causados a si próprio, ao Transcenda ou a terceiros, relacionados com a utilização que fizer do Transcenda, comprometendo-se a proceder às indemnizações necessárias, em virtude de qualquer acção, reclamação ou condenação a que essa utilização dê origem. </p>

		<p class="termo">O Transcenda não garante que os serviços prestados por este website funcionem de forma contínua ou que se encontrem livres de erros, vírus ou outros elementos prejudiciais. </p>

		<p class="termo">O Transcenda não é responsável pela exactidão, qualidade, segurança, legalidade ou licitude, incluindo o cumprimento das regras respeitantes a direitos de autor e direitos conexos, relativamente aos conteúdos, produtos ou serviços contidos neste website que tenham sido criados ou fornecidos por membros, utilizadores, anunciantes ou parceiros comerciais, bem como por qualquer informação contida em sites de terceiros para os quais este website estabeleça ligações. </p>

		<p class="termo">O Utilizador declara autorizar, a título gratuito, a divulgação, publicação, utilização e exploração dos conteúdos, textos, dados, imagens ou programas por si enviados para o Transcenda.teste</p> 

		<p class="termo">O Utilizador declara igualmente que: <br>
		tem plena legitimidade para autorizar a utilização previamente mencionada e, concretamente, que obteve e dispõe dos necessários direitos e autorizações a título de direitos de autor e assegurou os pagamentos eventualmente devidos a terceiros legítimos titulares de direitos sobre os conteúdos, textos, dados, imagens ou programas por si enviados para o Transcenda, para efeitos da sua utilização nos termos previstos na presente declaração; sobre o direito de autorizar a utilização dos conteúdos, textos, dados, imagens ou programas por si enviados para o Transcenda constantes da presente declaração, não existe qualquer reclamação ou processo instaurado ou alguma contestação relativamente à sua titularidade por parte de terceiros; não existe nenhum compromisso nem nenhuma condição decorrente de relações jurídicas eventualmente existentes entre o Utilizador e terceiros que impeça ou condicione, de algum modo, a execução total ou parcial da presente declaração nos termos nela definidos. O Transcenda exime-se de qualquer responsabilidade resultante da falta de veracidade do anteriormente declarado ou da violação pelo Utilizador de quaisquer direitos ou interesses legitimamente protegidos de terceiros. O Transcenda reserva-se no direito de livremente (sem obrigatoriedade de invocar qualquer motivo) e em qualquer momento, remover ou não publicar, total ou parcialmente, quaisquer conteúdos, textos, dados, imagens, aplicações ou programas, editados por si ou pelo Utilizador, sem que por tal facto advenha qualquer direito de indemnização ou compensação para o Utilizador ou quaisquer terceiros. </p>

		<p class="termo">Não existe qualquer obrigação do Transcenda em guardar os conteúdos, textos, dados, imagens ou programas publicados neste website, podendo os mesmos ser destruídos a qualquer momento, sem que por tal facto advenha qualquer direito de indemnização para o Utilizador ou quaisquer terceiros.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok, eu li!</button>

      </div>
    </div>
  </div>
</div>

</section>

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