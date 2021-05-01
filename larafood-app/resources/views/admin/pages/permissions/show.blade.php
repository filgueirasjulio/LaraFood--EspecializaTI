@extends('adminlte::page')

@section('title', "{$permission->name}}")

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{$permission->name}}</h1> <a href="{{route('permissions.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul style="list-style:none;">
                <li style="padding-bottom:10px;">
                    <strong>Nome: </strong> {{ $permission->name }}
                </li>
                <li style="padding-bottom:10px;">
                    <strong>Descrição: </strong> {{$permission->description}}
                </li>
                <li>
                    @include('admin.includes.alerts')
                    <form action="{{route('permissions.destroy', $permission->id)}}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"  alt="Remover">
                            <strong style="font-size:16px;padding-right:5px;"><i class="fas fa-trash-alt"></i></strong>  Deletar 
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@stop
