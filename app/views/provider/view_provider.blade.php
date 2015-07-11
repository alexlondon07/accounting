@extends('template.generic_admin')

@section('head_content')
@stop

@section('body_content')
@if(Auth::user()->hasRole('3'))
<div class="container-fluid">
    <div class="row">
        <div class="main">
            <h1 class="page-header">Proveedores</h1>
            <div class="controls form-inline">
                @if(Auth::user()->hasRole('3.1'))
                <a href="{{ URL::to('/') }}/admin/provider/create" class="btn btn-primary pull-right">Crear proveedor</a>
                @endif
                <div class="input-group">
                    {{ Form::open(array('url' => 'admin/providers/search', 'id' => 'search_form', 'method'=>'GET', 'class'=>'control-group')) }}
                    <div class="form-group">
                        <input id="search" placeholder="Buscar..." required="true" name="search" type="text" class="form-control" value="@if(isset($search)){{ $search }}@endif" />
                    </div>
                    <button class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    <a href="{{URL::to('/')}}/admin/provider" title="Refrescar Proveedores"class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
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
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Nit</th>
                            <th>Telefono</th>
                            <th>Pais</th>
                            <th>Departamento</th>
                            <th>Ciudad</th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td style="width: 150px !important">
                                <table>
                                    <tr>
                                        <td><a title="Detalles" href="{{ URL::to('/') }}/admin/provider/{{ $item->id }}"><span class="glyphicon glyphicon-eye-open btn btn-default btn-xs"></span></a></td>
                                        @if(Auth::user()->hasRole('3.2'))
                                        <td><a title="Editar" href="{{ URL::to('/') }}/admin/provider/{{ $item->id }}/edit"><span class="glyphicon glyphicon-edit btn btn-default btn-xs"></span></a></td>
                                        @endif
                                        @if(Auth::user()->hasRole('3.3'))
                                        <td>{{ Form::open(['action' => ['ProviderController@destroy', $item->id], 'method' => 'delete', 'style' => 'display: inline;']) }}
                                            <button title="Eliminar" type="submit" onclick="return Util.confirmDelete(this);" class="glyphicon glyphicon-trash btn btn-default btn-xs"></button>
                                            {{ Form::close() }}
                                        </td>
                                        @endif
                                    </tr>
                                </table>
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nit }}</td>
                            <td>{{ $item->telephone }}</td>
                            <td>{{ $item->country }}</td>
                            <td>{{ $item->department }}</td>
                            <td>{{ $item->city }}</td>
                            <td>{{ $item->address }}</td>
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
@endif
@stop
