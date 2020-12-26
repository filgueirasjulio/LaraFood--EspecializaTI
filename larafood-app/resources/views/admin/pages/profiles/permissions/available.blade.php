@extends('adminlte::page')

@section('title', 'Permissões disponíveis')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Permissões disponíveis para o perfil {{$profile->name}} </h1> <a href="{{route('profiles.permissions', $profile->id )}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
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
                           <th width="50px">#</th>
                           <th>Nome<th>
                    </thead>
                    <tbody>
                        <form action="{{ route('profiles.permissions.attach', $profile->id) }}" method="POST">
                            @csrf
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                </td>
                                <td>
                                    {{ $permission->name }}
                               </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="500">
                                    <button type="submit" class="btn btn-dark">
                                        Vincular
                                    </button>
                                </td>
                            </tr>
                        </form>
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
