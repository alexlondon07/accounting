@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@if($client->id) Editar @else Crear @endif</h3>
        </div>
        <div class="panel-body">
            @if($client->id)
            @if(Auth::user()->hasRole('1.2'))
            {{ Form::model($client, ['id' => 'form_client', 'route' => ['admin.client.update', $client->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @else
            @if(Auth::user()->hasRole('1.1'))
            {{ Form::model($client, ['id' => 'form_client', 'route' => 'admin.client.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @endif
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
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/client" class="btn btn-info">Cancelar</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

</div>
@else
<!-- Contenido de la visualizacion del item -->
<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Detalles Cliente</h3>
    </div>
    <div class="panel-body">
        {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
        <div class="form-group">
            {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('name',$client->name, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('email',$client->email, array('class' => 'form-control'))}}
            </div> </div>
            <div class="form-group">
                {{Form::label('nit', 'Nit', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('nit',$client->nit, array('class' => 'form-control'))}}
                </div>  
            </div>  
            <div class="form-group">
                {{Form::label('telephone', 'Telefono', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('telephone',$client->telephone, array('class' => 'form-control'))}}
                </div>          
            </div>          
            <div class="form-group">
                {{Form::label('country', 'Pais', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('country',$client->country, array('class' => 'form-control'))}}
                </div> 
            </div> 
            <div class="form-group">
                {{Form::label('department', 'Departamento', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('department',$client->department, array('class' => 'form-control'))}}
                </div>   
            </div>   
            <div class="form-group">
                {{Form::label('city', 'Ciudad', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('city',$client->city, array('class' => 'form-control'))}}
                </div> 
            </div> 
            <div class="form-group">
                {{Form::label('address', 'Direccion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('address',$client->address, array('class' => 'form-control'))}}
                </div> 
            </div> 
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $client->enable, array('class'=>'form-control','disabled' => 'true')) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <a href="{{URL::to('/')}}/admin/client" class="btn btn-info">Volver</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    @endif
    @stop
