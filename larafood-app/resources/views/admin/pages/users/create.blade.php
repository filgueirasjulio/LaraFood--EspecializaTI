@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
<div class="container">
    <div class="row justify-content-between">
        <h1>Novo Usuário</h1> <a href="{{route('users.index')}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
    </div>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('users.store')}}" method="POST" class="form">
            @csrf

            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
            </div>
            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" class="form-control" placeholder="Nome:" value="{{ $user->email ?? old('email') }}">
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="password" class="form-control" placeholder="Senha:">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>
</div>
@stop