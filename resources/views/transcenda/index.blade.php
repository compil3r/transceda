@extends('layouts.layout')
@section('titulo', 'Pagina Inicial')

@section('conteudo')
    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="t nexa-light">[t]</span>
                    <div class="intro-text margin">
                        <span class="name"><span class="nexa-light">projeto</span><span class="nexa-bold">transcenda</span></span>
                        <hr class="star-light">
                        <span class="skills nexa-light">1. Passar além de; <br> 2. Elevar-se acime de;  <br>3. Exceder.</span> <br><span class="nexa-light">Definição de <span class="nexa-bold">Transcenda</span> do Aurélio</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="nexa-light">O QUE VOCE QUER?</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 portfolio-item">
                    <a  data-toggle="modal" data-target="#modalDoar" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <h2 class="nexa-bold">DOAR</h2>
                            </div>
                        </div>
                        <img src="img/btnDoar.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-6 portfolio-item">
                    <a href="/cadastrar-historia" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <h2 class="nexa-bold">PUBLICAR</h2>
                            </div>
                        </div>
                        <img src="img/btnContar.png" class="img-responsive" alt="">
                    </a>
                </div>


            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>ÚLTIMAS HISTÓRIAS</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">      

                        <div class="carousel-inner" role="listbox">
                           <?php $num = 0; ?>
                           @foreach($historia as $historia)

                            @if ($num == 0)
                            <div class="item active">
                            @else 
                            <div class="item">
                            @endif
                                <img src="imagem/{{$historia->imagem}}" class="img-profile img-responsive img-circle">
                                <p><h3>{{$historia->autor->name}} {{$historia->total}}</h3></p>
                                  <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8">
                                    <div class="progress">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="{{$historia->meta}}" style="width: 10%">
                                    </div>
                                    </div>
                                  </div> 
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <p>{{substr($historia->descricao, 0, 350)}}...</p>
                                </div>    
                                <a href="/perfil/{{$historia->id}}" class="btn  btn-lg btn-outline">REALIZAR DOAÇÃO</a>
                            </div>
                            <?php $num++; ?>
                           @endforeach
                            
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div></div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>DADOS IMPORTANTES</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </section>

@endsection
