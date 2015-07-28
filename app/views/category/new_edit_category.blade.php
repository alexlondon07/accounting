@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list"></i>  @if($category->id) Editar @else Crear @endif categoria</h3>
        </div>
        <div class="panel-body">
            @if($category->id)
            @if(Auth::user()->hasRole('5.2'))
            {{ Form::model($category, ['id' => 'form_category', 'route' => ['admin.category.update', $category->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @else
            @if(Auth::user()->hasRole('5.1'))
            {{ Form::model($category, ['id' => 'form_category', 'route' => 'admin.category.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @endif
            @if(!empty($category))
            <div class="form-group @if ($errors->has('name')) has-error @endif">
                {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('name',null, array('class' => 'form-control'))}}
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::textarea('description',null, array('class' => 'form-control', 'size' => '20x4'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            @else
            <p class="">No existe información para esta categoria</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/category" class="btn btn-info">Cancelar</a>
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
        <h3 class="panel-title">Detalles Categoria</h3>
    </div>
    <div class="panel-body">
        {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
        @if(!empty($category))
        <div class="form-group">
            {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('name',$category->name, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::textarea('description',$category->description, array('class' => 'form-control', 'size' => '20x4'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $category->enable, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        @else
        <p class="">No existe información para esta categoria</p>
        @endif
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <a href="{{URL::to('/')}}/admin/category" class="btn btn-info">Volver</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endif
@stop
