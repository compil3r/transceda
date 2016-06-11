@extends('layouts.layout')
@section('conteudo')
<section id="contar"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Registre-se</h2>
                <hr class="star-primary">
                Já tem uma conta? <a href="/login">Faça Login!</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opa!</strong> Parece que nós temos alguns erros.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li> 
                            @if($error)
                               {{$error}} 
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <form enctype="multipart/form-data" class="form" role="form" method="POST" action="/register" >
                 <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                    <div class="row control-group">
                        <div class="form-group col-xs-12">
                            <label> Nome: </label>
                            <input type="text" class="form-control" name="name">                        
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-6">
                            <label> CPF: </label>
                            <input type="text" id="cpf" class="form-control" name="cpf">                        
                        </div>
                        <div class="form-group col-xs-6">
                            <label> Nascimento: </label>
                            <input type="date" class="form-control" name="nascimento">                        
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-6 col-md-6 ">
                            <label> Estado: </label>
                            <select name="estado" class="form-control" size="1" placeholder="Teste">
                                <option value="">  </option>
                                @foreach ($estados as $estados)
                                <option value="{{$estados->id}}">{{$estados->uf}}</option>
                                @endforeach
                            </select>                        
                        </div>
                        <div class="form-group col-xs-6 left">
                            <label> Cidade: </label>
                            <select name="cidade" class="form-control" size="1" placeholder="Teste">
                                <option value=""> </option>
                            </select>                     
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12">
                            <label> Email: </label>
                            <input type="email" class="form-control" name="email">                        
                        </div>
                    </div>                   
                    <div class="row control-group">
                        <div class="form-group col-xs-6">
                            <label>Senha:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Confirme a senha:</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="row control-group">
                    
                    <div class="form-group col-xs-12 ft">

                            <span class="btn btn-md btn-block btn-default fileinput-button">
                                <span>Escolher foto de perfil</span>
                                <input type="file" name="imagem" id="files">
                            </span>
                            <output id="list"></output>

                    </div>
                </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12">
                            <input type="checkbox" value="sim" name="termos" class="form"> Eu li e concordo com os <a href="#">termos e condições</a>.
                        </div>
                    </div>
                    <br>
                    <div class="row control-group">
                        <div class="col-xs-1"></div>
                        <div class="form-group col-xs-5">
                            <a href="/home" class="btn btn-block btn-default">Cancelar</a>
                        </div>
                        <div class="form-group col-xs-5">
                            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
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
    <script src="/js/mascaras.js"></script>
    @endsection

    @section('script')
    <script src="/js/transcendaJcrop.js"></script>
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