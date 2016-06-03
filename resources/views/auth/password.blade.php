
@extends('layouts.layout')
@section('titulo', 'Esqueci minha senha')

@section('conteudo')
<section id="portfolio">
<div class="container-fluid">
 <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Esqueci minha senha</h2>
                <hr class="star-primary">
                Calma! Te enviaremos um e-mail com as instruções.
            </div>
 </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
         @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Ops!</strong> Parece que tivemos alguns problemas.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                   <form class="form-horizontal" role="form" method="POST" action="/esqueci-minha-senha">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                         <div class="row control-group">
                            <div class="form-group col-xs-2"></div>
                            <div class="form-group col-xs-8">
                                <label> Email: </label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">                  
                            </div>
                        </div>
                            
                        
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="submit" class="btn btn-block btn-primary" style="margin-right: 15px;">Enviar e-mail</button>
                            </div>
                        </div>
                    </form>

        </div>
    </div>
</div>
</section>
@endsection