@extends('template.generic_admin')

@section('head_content')
@stop

@section('body_content')
<div class="container-fluid">
  <div class="row">
    <div class="main">
      <h1 class="page-header">Compras </h1>
        <div class="controls form-inline">
            @if(Auth::user()->hasRole('7.1'))
            <a href="{{ URL::to('/') }}/admin/shopping/create" class="btn btn-primary pull-right">Ingresar shoppingo</a>
            @endif
            <div class="input-group">
              {{ Form::open(array('url' => 'admin/shoppings/search', 'id' => 'search_form', 'method'=>'GET', 'class'=>'control-group')) }}
                <div class="form-group">
                    <input id="search"  name="search"  type="text" required="true" class="form-control" placeholder="Buscar..." value="@if(isset($search)){{ $search }}@endif" >
                </div>
              <button class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
              <a href="{{URL::to('/')}}/admin/shopping" title="Refrescar Compras"class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
              {{ Form::close() }}
          </div>
        </div>
        <div class="table-responsive">
          @if (count($items) > 0)
          <h4>{{$items->getTotal()}} resultados </h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>&nbsp;</th>
                <th>Descripcion</th>
                <th>Responsable</th>
                <th>Fecha</th>
                <th>Habilitado</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
              <tr>
                <td style="width: 90px !important">
                 <table>
                  <tr>
                    <td><a title="Detalles" href="{{ URL::to('/') }}/admin/shopping/{{ $item->id }}"><span class="glyphicon glyphicon-eye-open btn btn-default btn-xs"></span></a></td>
                    @if(Auth::user()->hasRole('7.2'))
                    <td><a title="Editar" href="{{ URL::to('/') }}/admin/shopping/{{ $item->id }}/edit"><span class="glyphicon glyphicon-edit btn btn-default btn-xs"></span></a></td>
                    @endif
                    @if(Auth::user()->hasRole('7.3'))
                    <td>{{ Form::open(['action' => ['ShoppingController@destroy', $item->id], 'method' => 'delete', 'style' => 'display: inline;']) }}
                      <button title="Eliminar" type="submit" onclick="return Util.confirmDelete(this);" class="glyphicon glyphicon-trash btn btn-default btn-xs"></button>
                      {{ Form::close() }}
                    </td>
                    @endif
                  </tr>
                </table>
              </td>
              <td>{{ $item->description }}</td>
              <td>{{ $item->resposible }}</td>
              <td>{{ $item->date_shopping }}</td>
              <td>{{ $item->enable }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <nav class="text-center">
          {{$items->appends(Request::input())->links()}}
        </nav>
        @else
        No hay datos!
        @endif
      </div>
    </div>
  </div>
</div>
@stop
