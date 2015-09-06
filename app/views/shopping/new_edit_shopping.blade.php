@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-usd"></i> @if($shopping->id) Editar @else Crear @endif Compras</h3>
        </div>
        <div class="panel-body">
            @if($shopping->id)
            @if(Auth::user()->hasRole('7.2'))
            {{ Form::model($shopping, ['id' => 'form_shopping', 'route' => ['admin.shopping.update', $shopping->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @else
            @if(Auth::user()->hasRole('7.1'))
            {{ Form::model($shopping, ['id' => 'form_shopping', 'route' => 'admin.shopping.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @endif

            @if (!empty($shopping))
            {{ Form::hidden('shopping_id', $shopping->id, array('id' => 'shopping_id')) }}
            {{ Form::hidden('deletable', 'true', array('id' => 'deletable')) }}
            {{ Form::hidden('editable', 'true', array('id' => 'editable')) }}
            

            <!--Mensajes de validationes-->
            @include('messages-validations')
            <!--Fin Mensajes de validationes-->
            <div class="form-group">
                {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::textarea('description',null, array('class' => 'form-control' , 'size' => '20x4'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('date_shopping', 'Fecha', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('date_shopping',null, array('class' => 'form-control datepicker'))}}
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
                {{Form::label('table_products', 'Productos', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    <input type="hidden" name="table_products" id="table_products"/>
                    <div id="div_products"></div>
                </div>
            </div>
            @else
            <p class="">No existe información para éste compra</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/shopping" class="btn btn-info">Cancelar</a>
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
        <h3 class="panel-title">Detalles Compra</h3>
    </div>
    <div class="panel-body">
        {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
        @if(!empty($shopping))
        <div class="form-group">
            {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('description',$shopping->description, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
                {{Form::label('date_shopping', 'Fecha', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                {{Form::label('date_shopping',$shopping->date_shopping, array('class' => 'form-control'))}}
                </div>
        </div>
        <div class="form-group">
            {{Form::label('resposible', 'Responsable', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('resposible',array('Alexander'=>'Alexander','Estefany'=>'Estefany'), $shopping->resposible, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $shopping->enable, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        @else
        <p class="">No existe información para éste costo</p>
        @endif
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <a href="{{URL::to('/')}}/admin/shopping" class="btn btn-info">Volver</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endif
@stop
@section('javascript_content')
<script type="text/javascript" src="{{ URL::to('/') }}/js/Shopping.js?v={{ Util::version() }}"></script>
@stop