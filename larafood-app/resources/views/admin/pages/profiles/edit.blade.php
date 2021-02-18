@extends('adminlte::page')

@section('title', "Editar {$profile->name}")

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Editar {{$profile->name}}</h1> <a href="{{route('profiles.index')}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('profiles.update', $profile->id)}}" method="POST" class="form">
                @csrf
                @method('PUT')

                @include('admin.pages.profiles.partials.form')
            </form>
       </div>
   </div>
@stop