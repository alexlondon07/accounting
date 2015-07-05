@extends('template.generic_admin')

@section('head_content')
@stop

@section('body_content')
<div class="container-fluid">
  <div class="row">
    <div class="main">
      <h1 class="page-header">Clientes</h1>
      <div class="controls form-inline">
        @if(Auth::user()->hasRole('1.1'))
        <a href="{{ URL::to('/') }}/admin/client/create" class="btn btn-primary">Crear cliente</a>
        @endif
        <div class="input-group">
          {{ Form::open(array('url' => 'admin/clients/search', 'id' => 'search_form', 'method'=>'GET', 'class'=>'control-group')) }}
          <input id="search" placeholder="Buscar..." required="true" name="search" type="text" value="@if(isset($search)){{ $search }}@endif" />
          <button class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
          <a href="{{URL::to('/')}}/admin/client" title="Refrescar Clientes"class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
          {{ Form::close() }}
        </div>
        <div class="table-responsive">
          @if (count($items) > 0)
          <h4>{{$items->getTotal()}} resultados </h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>&nbsp;</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Habilitado</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
              <tr>
                <td style="width: 90px !important">
                 <table>
                  <tr>
                    <td><a title="Detalles" href="{{ URL::to('/') }}/admin/client/{{ $item->id }}"><span class="glyphicon glyphicon-eye-open btn btn-default btn-xs"></span></a></td>
                    @if(Auth::user()->hasRole('1.2'))
                    <td><a title="Editar" href="{{ URL::to('/') }}/admin/client/{{ $item->id }}/edit"><span class="glyphicon glyphicon-edit btn btn-default btn-xs"></span></a></td>
                    @endif
                    @if(Auth::user()->hasRole('1.3'))
                    <td>{{ Form::open(['action' => ['ClientController@destroy', $item->id], 'method' => 'delete', 'style' => 'display: inline;']) }}
                      <button title="Eliminar" type="submit" onclick="return Util.confirmDelete(this);" class="glyphicon glyphicon-trash btn btn-default btn-xs"></button>
                      {{ Form::close() }}
                    </td>
                    @endif
                  </tr>
                </table>
              </td>
              <td>{{ $item->name }}</td>   
              <td>{{ $item->telephone }}</td>
              <td>{{ $item->address }}</td>
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
