@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@if($cost->id) Editar @else Crear @endif</h3>
        </div>
        <div class="panel-body">
            @if($cost->id)
            @if(Auth::user()->hasRole('4.2'))
            {{ Form::model($cost, ['id' => 'form_cost', 'route' => ['admin.cost.update', $cost->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @else
            @if(Auth::user()->hasRole('4.1'))
            {{ Form::model($cost, ['id' => 'form_cost', 'route' => 'admin.cost.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @endif
            <div class="form-group">
                {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('name',null, array('class' => 'form-control', 'required' => 'required'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('type', 'Tipo', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('type',array('Pasajes compra de pedido'=>'Pasajes compra de pedido','Pasajes Viajes'=>'Pasajes Viajes','Otro'=>'Otro'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('value', 'Valor', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('value',null, array('class' => 'form-control' , 'required' => 'required'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::textarea('description',null, array('class' => 'form-control', 'required' => 'required' , 'size' => '20x4'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('date_cost', 'Fecha', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('date_cost',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('resposible', 'Responsable', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('resposible',array('Alexander'=>'Alexander','Estefany'=>'Estefany'), null, array('class'=>'form-control')) }}
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
                    <a href="{{URL::to('/')}}/admin/cost" class="btn btn-info">Cancelar</a>
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
        <h3 class="panel-title">Detalles Costo</h3>
    </div>
    <div class="panel-body">
        {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
        <div class="form-group">
            {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('name',$cost->name, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('type', 'Tipo', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('type',array('Pasajes compra de pedido'=>'Pasajes compra de pedido','Pasajes Viajes'=>'Pasajes Viajes','Otro'=>'Otro'), $cost->type, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('value', 'Valor', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('value',$cost->value, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('description',$cost->description, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
                {{Form::label('date_cost', 'Fecha', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                {{Form::label('date_cost',$cost->date_cost, array('class' => 'form-control'))}}
                </div>
            </div>
        <div class="form-group">
            {{Form::label('resposible', 'Responsable', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('resposible',array('Alexander'=>'Alexander','Estefany'=>'Estefany'), $cost->resposible, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $cost->enable, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <a href="{{URL::to('/')}}/admin/cost" class="btn btn-info">Volver</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endif
@stop
