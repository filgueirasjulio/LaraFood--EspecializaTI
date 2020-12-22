@extends('adminlte::page')

@section('title', 'Novo Perfil')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Novo Perfil</h1> <a href="{{route('profiles.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('profiles.store')}}" method="POST" class="form">
                @csrf
             
                @include('admin.pages.profiles.partials.form')
            </form>
       </div>
   </div>
@stop
