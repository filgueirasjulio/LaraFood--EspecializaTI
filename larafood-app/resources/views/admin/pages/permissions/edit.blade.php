@extends('adminlte::page')

@section('title', "Editar {$permission->name}")

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Editar {{$permission->name}}</h1> <a href="{{route('permissions.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('permissions.update', $permission->id)}}" method="POST" class="form">
                @csrf
                @method('PUT')

                @include('admin.pages.permissions.partials.form')
            </form>
       </div>
   </div>
@stop