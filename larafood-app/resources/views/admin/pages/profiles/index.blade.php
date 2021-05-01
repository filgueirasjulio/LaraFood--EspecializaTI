@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Perfis</h1> <a href="{{ route('profiles.create') }}" class="btn btn-dark"><strong
                style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> Perfil</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('profiles.search') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                    <a href="{{route('profiles.index')}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                    <hr>
                @endif
            </div>
        </div>
        <div class="card-body table-responsive">
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($profiles->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th style="width:180px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>
                                    {{ $profile->name }}
                                </td>
                                <td>
                                    <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-sm btn-info" alt="Ver"
                                        title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-sm btn-warning" alt="Editar"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-sm btn-secondary" alt="Permissões"
                                        title="Permissões"><i class="fas fa-key"></i></a>
                                    <a href="{{ route('profiles.plans', $profile->id) }}" class="btn btn-sm" style="background-color: #b2ff59;" alt="Planos"
                                        title="Planos"><i class="fas fa-clipboard-list"></i></a>
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
                {!! $profiles->appends($filter) !!}
            @else
                {!! $profiles !!}
            @endif

        </div>
    </div>
@stop
