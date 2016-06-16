<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="/js/jquery.js"></script>

    <link rel="shortcut icon" href="/img/icone.png" type="image/x-icon">
     <meta name="csrf-token" content="{{{ Session::token() }}}">
    <title>Projeto [Trans]cenda - @yield('titulo')</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="/css/t.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/transcenda.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    @section('head')
    <style type="text/css" media="screen">
    footer {
        position: relative;
    }
        
    </style>
    @show
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="page-top" class="index">

        <!-- Navigation -->
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><span class="nexa-light">projeto</span><span class="nexa-bold">transcenda</span></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="/"></a>
                        </li>
                        <li class="page-scroll">
                            <a href="/">INICIO</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#about">SOBRE</a>
                        </li>
                        @if (Auth::guest())
                        <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">LOGIN <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/login">Entrar</a></li>
                            <li><a href="/register">Registrar</a></li>
                            
                        </ul>
                    </li>
                    @else
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="/imagem/{{Auth::user()->imagem}}" class="img-menu img-circle"> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/configuracoes/perfil" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Configurações</a></li>
                        <li><a href="/configuracoes/mensagens" >Mensagens <span class="badge" style="background-color: pink; color: white;">{{$mensagensT}}</span></a> </li>
                        <li><a href="/logout">Sair</a></li>

                    </ul>
                </li>
                @endif    
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

@section('conteudo')


@show


<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">

                <div class="footer-col col-md-4">
                    <h3>Acompanhe</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.facebook.com/profile.php?id=1601011946807805&ref=ts&fref=ts" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                           <!--  <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li> -->
                            <li>
                                <a href="https://twitter.com/ptranscenda" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <!--<li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Sobre</h3>
                        <p>Transcenda foi desenvolvido por Vitor Hugo Lopes como trabalho de conclusão de curso na UFSM.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Transcenda 2015
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>


    <!-- jQuery -->


    @section('jquery')
    @show
    <!-- Bootstrap Core JavaScript -->

    <script src="/js/t.min.js"></script>


    <!-- Plugin JavaScript -->
    <!-- script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script -->
    <script src="/js/classie.js"></script>
    <!--<script src="js/cbpAnimatedHeader.js"></script>-->

    <!-- Contact Form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <!--    <script src="js/contact_me.js"></script> -->
    <script src="/js/transcenda.js"></script>
    
    @section('script')

    @show
</body>

</html>