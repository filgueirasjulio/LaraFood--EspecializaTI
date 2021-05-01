@extends('adminlte::page')

@section('title', "Perfis - {$permission->name}")

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Perfis - {{$permission->name}} </h1> <a href="{{route('permissions.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('permissions.profiles.search', $permission->id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                    <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                        <a href="{{route('permissions.profiles', $permission->id)}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                    <hr>
                @endif
            </div>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($profiles->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>
                                    {{ $profile->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhum perfil encontrado!</td>
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