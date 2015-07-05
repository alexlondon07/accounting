<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Optimized mobile viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--Fin Optimized mobile viewport -->
        <META NAME="Author" CONTENT="www.secuencia24.com"/>
        <title>Accounting :: Personal Accounting</title>
        <!--styles-->
        <link rel="icon" type="image/x-icon" href="{{ URL::to('/') }}/images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/bootstrap/bootstrap.css" />
        <!--FIN styles-->
    </head>
    <body>
        <div id="body_wrapper">
            <div align="center" class="container"  style="margin: 0 auto !important; width: 30%;">
                {{ Form::open(array('url' => 'login', 'id' => 'login_form', 'class' => 'form-signin')) }}
                <h2 class="form-signin-heading">Accounting.</h2>
                <label  class="sr-only">Usuario</label>
                {{ Form::text('username', null, array('placeholder' => 'Usuario', 'class' => 'form-control')) }}
                <label for="inputPassword" class="sr-only">Contraseña</label>
                {{ Form::password('password', array('placeholder' => 'Contraseña', 'class' => 'form-control')) }}
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
                {{ Form::close() }}
            </div>
        </div>
        <script type="text/javascript" src="{{ URL::to('/') }}/js/jquery/jquery-1.11.3.min.js"></script>
    </body>
</html>
