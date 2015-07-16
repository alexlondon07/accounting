@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@if($user->id) Editar @else Crear @endif Usuario</h3>
        </div>
        <div class="panel-body">
            @if($user->id)
              @if(Auth::user()->hasRole('2.2'))
              {{ Form::model($user, ['id' => 'form_user', 'route' => ['admin.user.update', $user->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
              {{Form::hidden('username_old', $user->username, array('id'=>'username_old'))}}
              @endif
            @else
              @if(Auth::user()->hasRole('2.1'))
              {{ Form::model($user, ['id' => 'form_user', 'route' => 'admin.user.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
              @endif
            @endif

            @if (!empty($user))
            <div class="form-group">
                {{Form::label('firstname', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('firstname',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('lastname', 'Apellido', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('lastname',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::email('email',null, array('class' => 'form-control'))}}
                    <div></div>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('position', 'Cargo', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('position',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('identification', 'Identificación', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('identification',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone', 'Telefono', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('telephone',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('cellphone', 'Celular', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('cellphone',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('username', 'Usuario', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('username',null, array('class' => 'form-control'))}}
                    <div></div>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('password', 'Contraseña', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::password('password', array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('profile', 'Perfil', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('profile',array('operario'=>'Operario','supervisor'=>'Supervisor','super_admin'=>'Administrador'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            @else
            <p class="">No existe información para éste usuario</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/user" class="btn btn-info">Cancelar</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

    @else
    <!-- Contenido de la visualizacion del item -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Detalles Usuario</h3>
        </div>
        <div class="panel-body">
            {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
            @if (!empty($user))
            <div class="form-group">
                {{Form::label('firstname', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('firstname',$user->firstname, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('lastname', 'Apellido', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('lastname',$user->lastname, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('email',$user->email, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('position', 'Cargo', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('position',$user->position, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('identification', 'Identificación', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('identification',$user->identification, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone', 'Telefono', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('telephone',$user->telephone, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('cellphone', 'Celular', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('cellphone',$user->cellphone, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('username', 'Usuario', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('username',$user->username, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('profile', 'Perfil', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('profile',array('operario'=>'Operario','supervisor'=>'Supervisor','super_admin'=>'Administrador'), $user->profile, array('class'=>'form-control','disabled' => 'true')) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $user->enable, array('class'=>'form-control','disabled' => 'true')) }}
                </div>
            </div>
            @else
            <p class="">No existe información para éste usuario</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <a href="{{URL::to('/')}}/admin/user" class="btn btn-info">Volver</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    @endif
</div>
@stop
@section('javascript_content')
<script type="text/javascript" src="{{ URL::to('/') }}/js/User.js?v={{ Util::version() }}"></script>
@stop
