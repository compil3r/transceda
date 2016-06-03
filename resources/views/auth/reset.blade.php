@extends('layouts.layout')
@section('conteudo')
<section id="portfolio">
    <div class="container-fluid">
        <div class="row">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Alterar senha</h2>
                <hr class="star-primary">
            </div>
        </div>
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
</div>
</div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                        <form class="form-horizontal" role="form" method="POST" action="/senha/reset">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="token" value="{{ $token }}">
    

                            <div class="form-group col-xs-12">
                                <label>E-Mail:</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group col-xs-12">
                                <label>Nova senha:</label>
                                    <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group col-xs-12">
                                <label>Confirmar nova senha:</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="col-md-2 col-xs-2 col-sm-2 col-lg-2"></div>
                            <div class="form-group col-lg-8 col-sm-8 col-md-8 col-xs-8">
                               <button type="submit" class="btn btn-primary btn-block">
                                        Alterar senha
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
        </div>
    </div>
 </section>
@endsection