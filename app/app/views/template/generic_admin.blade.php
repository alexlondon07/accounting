<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/x-icon" href="{{ URL::to('/') }}/images/favicon.ico" />
        <title>Personal Accounting</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/bootstrap/bootstrap.css?v={{ Util::version() }}" />
        <!-- Custom styles for this template -->
        <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/bootstrap/dashboard.css?v={{ Util::version() }}" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('head_content')
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #2e6da4;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{URL::to('/')}}">Personal Accounting</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                        @if(Auth::user()->hasRole('1'))
                        <li><a href="{{URL::to('/')}}/admin/client" title="Clientes"><img src="{{URL::to('/')}}/images/clientes.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('2'))
                        <li><a href="{{URL::to('/')}}/admin/user" title="Usuarios"><img src="{{URL::to('/')}}/images/usuarios.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('3'))
                        <li><a href="{{URL::to('/')}}/admin/provider" title="Proveedor"><img src="{{URL::to('/')}}/images/proveedores.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('4'))
                        <li><a href="{{URL::to('/')}}/admin/location" title="Ubicaciones"><img src="{{URL::to('/')}}/images/ubicaciones.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('5'))
                        <li><a href="{{URL::to('/')}}/admin/machine" title="Maquinas"><img src="{{URL::to('/')}}/images/maquinas.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('6'))
                        <li><a href="{{URL::to('/')}}/admin/supply" title="Insumos"><img src="{{URL::to('/')}}/images/insumos.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('7'))
                        <li><a href="{{URL::to('/')}}/admin/frame" title="Marcos"><img src="{{URL::to('/')}}/images/marcos.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('8'))
                        <li><a href="{{URL::to('/')}}/admin/inkmix" title="Tinta Mezcla"><img src="{{URL::to('/')}}/images/tintamezcla.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('9'))
                        <li><a href="{{URL::to('/')}}/admin/reference" title="Referencias"><img src="{{URL::to('/')}}/images/referencias.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('10'))
                        <li><a href="{{URL::to('/')}}/admin/kit" title="Kit"><img src="{{URL::to('/')}}/images/kit.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('11'))
                        <li><a href="{{URL::to('/')}}/admin/requisition" title="Pedidos"><img src="{{URL::to('/')}}/images/pedidos.png" height="50"/></a></li>
                        @endif
                        @if(Auth::user()->hasRole('12'))
                        <li><a href="{{URL::to('/')}}/admin/order" title="Ordenes"><img src="{{URL::to('/')}}/images/ordenes.png" height="50"/></a></li>
                        @endif
                        <li><a href="{{URL::to('/')}}/logout" title="Cerrar sesión"><img src="{{URL::to('/')}}/images/salir.png" height="50"/></a></li>
                        @endif
                    </ul>
                </div>
            </div>
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
        <script type="text/javascript">var rootUrl = "{{ URL::to('/') }}/";</script>
        <script type="text/javascript" src="{{ URL::to('/') }}/js/Util.js?v={{ Util::version() }}"></script>
        @yield('javascript_content')
    </body>
</html>
