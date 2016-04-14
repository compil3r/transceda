@extends('layouts.layout')
@section('titulo', 'Pagina Inicial')

@section('conteudo')
    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/t.png" alt="">
                    <div class="intro-text">
                        <span class="name">transcenda</span>
                        <hr class="star-light">
                        <span class="skills">1.Passar alem de; <br> 2.Elevar-se acime de;  <br>3.Exceder.</span> <br><span>Definição de <i>Transceda</i> do Aurélio</span>
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
                    <h2>O que você quer?</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 portfolio-item">
                    <a  data-toggle="modal" data-target="#modalDoar" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <h2>REALIZAR UMA DOAÇÃO!</h2>
                            </div>
                        </div>
                        <img src="img/btnDoar.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-6 portfolio-item">
                    <a href="/cadastrar-historia" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <h2>CONTAR SUA HISTÓRIA!</h2>
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
                    <h2>Últimas Histórias</h2>
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
                                <p><h3>{{$historia->nomeSocial}}</h3></p>
                                <p>{{$historia->descricao}}</p>
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
@include('partials.modalDoar');
        <!-- Contact Section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Alguns Números</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </section>

@endsection
