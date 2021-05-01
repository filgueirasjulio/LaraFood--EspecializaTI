@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Mesas</h1> <a href="{{ route('tables.create') }}" class="btn btn-dark"><strong
                    style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> Mesa</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('tables.search') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                    <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                        <a href="{{route('tables.index')}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                @endif
            </div>
        </div>
        <div class="card-body table-responsive p-0">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($tables->count())
                    <thead>
                        <tr>
                            <th>Identificador</th>
                            <th>Descrição</th>
                            <th style="width:180px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tables as $table)
                            <tr>
                                <td>
                                    {{ $table->identify }}
                                </td>
                                <td>
                                    {{ $table->description }}
                                </td>
                                <td>
                                    <a href="{{ route('tables.show', $table->id) }}" class="btn btn-sm btn-info" alt="Ver"
                                        title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-sm btn-warning" alt="Editar"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhuma mesa para ser exibida!</td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filter))
                {!! $tables->appends($filter) !!}
            @else
                {!! $tables !!}
            @endif

        </div>
    </div>
@stop
