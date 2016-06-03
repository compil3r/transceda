@extends('layouts.layout')
@section('titulo', 'Realizar Login')

@section('conteudo')
<section id="portfolio">
<div class="container-fluid">
 <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Entrar</h2>
                <hr class="star-primary">
                Ainda não tem uma conta? <a href="/register">Registre-se!</a>
            </div>
 </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            Por favor, verifique os seguintes erros:<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                         <div class="row control-group">
                            <div class="form-group col-xs-2"></div>
                            <div class="form-group col-xs-8">
                                <label> Email: </label>
                                 {!! Form::text('email', null, ['class' => 'form-control', 'type' => 'email']) !!}                  
                            </div>
                        </div>
                            <div class="row control-group">
                             <div class=" col-xs-2"></div>
                            <div class="form-group col-xs-8">
                                <label> Senha: </label>
                                {!! Form::password('password', ['class' => 'form-control']) !!}                 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> {{ trans('validation.attributes.remember') }}
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="submit" class="btn btn-block btn-primary" style="margin-right: 15px;">{{ trans('validation.attributes.login') }}</button>
                                <p align="center"><small><small><a href="/esqueci-minha-senha">Esqueci minha senha</a></small></small></p>
                            </div>
                        </div>
                    </form>

        </div>
    </div>
</div>
</section>
@endsection