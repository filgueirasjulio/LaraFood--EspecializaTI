@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Permissões do perfil {{$profile->name}} </h1> <a href="{{ route('profiles.create') }}" class="btn btn-dark"><strong
                    style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> permissão</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($permissions->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
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
                                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-warning" alt="Editar"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhuma permissão para ser exibida!</td>
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
