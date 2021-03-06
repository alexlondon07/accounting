<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/x-icon" href="{{ URL::to('/') }}/images/favicon.ico" />
<title>Personal Accounting::</title>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/bootstrap/bootstrap.css?v={{ Util::version() }}" />
<!-- Custom styles for this template -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/bootstrap/dashboard.css?v={{ Util::version() }}" />

<!-- css de bootstrap datepicker-->
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/js/bootstrap/datepicker/css/datepicker.css?v={{ Util::version() }}" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

          <!-- Font -->
        @yield('head_content')
      </head>
      <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{URL::to('/')}}">Personal Accounting</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    @if(Auth::check())
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::user()->hasRole('1'))
                        <li><a href="{{URL::to('/')}}/admin/client" title="Clientes"><i class="fa fa-group"></i> Clientes</a></li>
                        @endif

                        @if(Auth::user()->hasRole('2'))
                        <li><a href="{{URL::to('/')}}/admin/user" title="Usuarios"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
                        @endif

                        @if(Auth::user()->hasRole('3'))
                        <li><a href="{{URL::to('/')}}/admin/provider" title="Proveedores"><i class="glyphicon glyphicon-bed"></i> Proveedores</a></li>
                        @endif

                        @if(Auth::user()->hasRole('4'))
                        <li><a href="{{URL::to('/')}}/admin/cost" title="Costos"><i class="glyphicon glyphicon-usd"></i> Costos</a></li>
                        @endif

                        @if(Auth::user()->hasRole('5'))
                        <li><a href="{{URL::to('/')}}/admin/category" title="Categorias"><i class="glyphicon glyphicon-list"></i> Categoria</a></li>
                        @endif

                        @if(Auth::user()->hasRole('6'))
                        <li><a href="{{URL::to('/')}}/admin/product" title="Productos"><i class="glyphicon glyphicon-oil"></i> Productos</a></li>
                        @endif

                        @if(Auth::user()->hasRole('7'))
                        <li><a href="{{URL::to('/')}}/admin/shopping" title="Compras"><i class="glyphicon glyphicon-shopping-cart"></i> Compras</a></li>
                        @endif
                        <li><a href="{{URL::to('/')}}/logout" title="Cerrar sesión"><i class="glyphicon glyphicon-off"></i> Cerrar sesión</a></li>
                    </ul>
                    @endif
                </div> <!-- end of ".navbar-collapse" -->
            </div> <!-- end of ".container" -->
        </nav>
        <div id="body_wrapper">
            @yield('body_content')
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {{ HTML::script('js/jquery/jquery-1.11.3.min.js') }}
        <script type="text/javascript" src="{{ URL::to('js/bootstrap/bootstrap.min.js') }}?v={{ Util::version() }}"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script type="text/javascript" src="{{ URL::to('/') }}/js/jquery/ie10-viewport-bug-workaround.js?v={{ Util::version() }}"></script>
        <!-- js de bootstrap 3 datepicker-->
        <script type="text/javascript" src="{{ URL::to('/') }}/js/bootstrap/datepicker/js/bootstrap-datepicker.js?v={{ Util::version() }}"></script>
        <script type="text/javascript">var rootUrl = "{{ URL::to('/') }}/";</script>
        <script type="text/javascript" src="{{ URL::to('/') }}/js/Util.js?v={{ Util::version() }}"></script>
        @yield('javascript_content')
    </body>
    </html>