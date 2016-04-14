@extends('layouts.layout')
@section('conteudo')
<section id="portfolio"> 
    <div class="container-fluid">
    <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Conte sua história</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">



                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="/register">
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
                <div class="row control-group"  >
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
                        Repita a senha anterior
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
</section>
@endsection

@section('jquery')
    <script src="/js/jquery.mask.min.js"></script>
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