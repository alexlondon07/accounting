@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-bed"></i> @if($provider->id) Editar @else Crear @endif proveedor</h3>
        </div>
        <div class="panel-body">
            @if($provider->id)
            @if(Auth::user()->hasRole('3.2'))
            {{ Form::model($provider, ['id' => 'form_provider', 'route' => ['admin.provider.update', $provider->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @else
            @if(Auth::user()->hasRole('3.1'))
            {{ Form::model($provider, ['id' => 'form_provider', 'route' => 'admin.provider.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @endif

            @if (!empty($provider))
            <!--Mensajes de validaciones-->
            @include('alert.messages-validations')
            <!--Fin Mensajes de validaciones-->
            <div class="form-group">
                {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('name',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::email('email',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('nit', 'Nit', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('nit',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone', 'Telefono', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('telephone',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('country', 'Pais', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('country',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('department', 'Departamento', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('department',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('city', 'Ciudad', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('city',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('address', 'Direccion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('address',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::select('enable',array('SI'=>'SI','NO'=>'NO'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            @else
            <p class="">No existe información para éste proveedor</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/provider" class="btn btn-info">Cancelar</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    @else
    <!-- Contenido de la visualizacion del item -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Detalles</h3>
        </div>
        <div class="panel-body">
            {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
            @if (!empty($provider))
            <div class="form-group">
                {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('name',$provider->name, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('email',$provider->email, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('nit', 'Nit', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('nit',$provider->nit, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone', 'Telefono', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('telephone',$provider->telephone, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('country', 'Pais', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('country',$provider->country, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('department', 'Departamento', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('department',$provider->department, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('city', 'Ciudad', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('city',$provider->city, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('address', 'Direccion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('address',$provider->address, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $provider->enable, array('class'=>'form-control','disabled' => 'true')) }}
                </div>
            </div>
            @else
            <p class="">No existe información para éste proveedor</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <a href="{{URL::to('/')}}/admin/provider" class="btn btn-info">Volver</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    @endif
</div>
@stop
