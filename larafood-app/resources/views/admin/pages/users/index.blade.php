@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Usuários</h1> <a href="{{ route('users.create') }}" class="btn btn-sm btn-dark"><strong
                    style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> Usuário</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('users.search') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                    <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                        <a href="{{route('users.index')}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                @endif
            </div>
        </div>
        <div class="card-body table-responsive p-0">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($users->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th style="width:180px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info" alt="Ver"
                                        title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" alt="Editar"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhum usuário para ser exibido!</td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filter))
                {!! $users->appends($filter) !!}
            @else
                {!! $users !!}
            @endif

        </div>
    </div>
@stop
