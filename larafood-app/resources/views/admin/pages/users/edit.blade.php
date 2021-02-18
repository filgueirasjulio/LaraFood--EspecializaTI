@extends('adminlte::page')

@section('title', "Editar - {$user->name}")

@section('content_header')
<div class="container">
    <div class="row justify-content-between">
        <h1>Editar {{$user->name}}</h1> <a href="{{route('users.index')}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
    </div>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('users.update', $user->id)}}" method="POST" class="form">
            @csrf
            @method('PUT')

            @include('admin.includes.alerts')

            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
            </div>
            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" class="form-control" placeholder="Nome:" value="{{ $user->email ?? old('email') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>
</div>
@stop