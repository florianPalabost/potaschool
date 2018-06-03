<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      @section('title')
        PotaSchool
      @show
    </title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/side-bar.css')}}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/jquery.auto-complete.css')}}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/open-iconic-bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <style>
      body {
        /*padding-top: 54px;*/
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }
      #menu-toggle{
        margin-right:1%;
      }

    </style>
    @yield('css')
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
      <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><span class="oi oi-menu" title="oi-menu" aria-hidden="true"></span>
        <a class="navbar-brand" href="{{ url('/') }}">PotaSchool</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Jeu
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/wiki') }}">Wiki</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
	          <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())

                        {{ Form::open(array('url' => '/logout','style'=>'display: inline-block;')) }}
                        {{ Form::button('Se déconnecter', array('class'=>'btn btn-danger deco', 'type'=>'submit')) }}
                        {{ Form::close() }}

                    @else
                        <a href="{{ url('/login') }}">Se Connecter</a>
                        <a href="{{ url('/register') }}">S'enregistrer</a>
                    @endif
                </div>
            @endif
        </div>
    </nav>

       @if (Route::has('login'))
       <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
            @if (Auth::check())
                <li class="sidebar-brand">
                <a href="{{ url('/profil') }}">Mon Profil</a>
                </li>
                <li class="sidebar-brand">
                <a href="{{ url('/cours/matiere') }}">Matières</a>
                </li>
                <li class="sidebar-brand">
                <a href="{{ url('/cours/module') }}">Modules</a>
                </li>
                <li class="sidebar-brand">
                <a href="{{ url('/cours/cours') }}">Cours</a>
                </li>
                <li class="sidebar-brand">
                <a href="{{ url('/cours/exercice') }}">Exercice</a>
                </li>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <li class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Mes Classes<i class="fas fa-plus"></i></a></li>
                        </div>
                        <li><div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <a href="{{route('classes.index')}}">Toute les classes</a>
                                @if(session('classesEnseignant')!==null)
                                @foreach(session('classesEnseignant') as $classe)
                                <a href="{{route('classes.show',$classe['id'])}}">{{$classe['nom']}}</a>
                                @endforeach
                                @endif
                            </div>
                            </div>
                        </li>
                     </div>
                </div>
            @endif
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        @endif
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container" style="margin-top:60px">

</span></a>
        @yield('content')
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('resources/assets/js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('resources/assets/js/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script>
       $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
    @yield('script')
  </body>
</html>
