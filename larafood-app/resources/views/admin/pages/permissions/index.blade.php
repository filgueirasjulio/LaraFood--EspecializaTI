@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Permissões</h1> <a href="{{ route('permissions.create') }}" class="btn btn-dark"><strong
                    style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> permissão</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('permissions.search') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}" placeholder="Buscar..">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                    <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                        <a href="{{route('permissions.index')}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                    <hr>
                @endif
            </div>
        </div>
        <div class="card-body table-responsive">
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($permissions->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th style="width:180px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    {{ $permission->name }}
                                </td>
                                <td>
                                    {{ $permission->description }}
                                </td>
                                <td>
                                    <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-sm btn-info" alt="Ver"
                                        title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning" alt="Editar"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('permissions.profiles', $permission->id) }}" class="btn btn-sm btn-secondary" alt="Perfis"
                                        title="Perfis"><i class="fas fa-users"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhum perfil para ser exibido!</td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filter))
                {!! $permissions->appends($filter) !!}
            @else
                {!! $permissions !!}
            @endif

        </div>
    </div>
@stop
