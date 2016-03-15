@extends('layouts.layout')
@section('conteudo')
<section id="perfil">
<div class="container">
<img class="img-responsive perfil" src="/imagem/{{$historia->imagem}}">
<h1 class="nome">{{$historia->nomeSocial}}</h1>
<h4><i>{{$historia->objetivo}}</i> - R$ {{$historia->meta}}</h4>
{{$historia->cidade}}
{{$historia->descricao}}

<br><br><a class="btn btn-success" href="#">Realizar Doacao</a>  <a class="btn btn-success" href="http://www.facebook.com/share.php?u=www.projetotranscenda.com&t=Ajude {{$historia->nomeSocial}}" target="_blank"">Compartilhar</a> 

</div>
</section>
@endsection