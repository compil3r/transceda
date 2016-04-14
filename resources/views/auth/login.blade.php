@extends('layouts.layout')
@section('titulo', 'Realizar Login')

@section('conteudo')
<section id="portfolio">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('validation.attributes.login') }}</div>
                <div class="panel-body">
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
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('validation.attributes.email') }}</label>
                            <div class="col-md-6">
                                {!! Form::text('email', null, ['class' => 'form-control', 'type' => 'email']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('validation.attributes.password') }}</label>
                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> {{ trans('validation.attributes.remember') }}
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">{{ trans('validation.attributes.login') }}</button>
                                <a href="/forgot">{{ trans('validation.attributes.forgotpassword') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection