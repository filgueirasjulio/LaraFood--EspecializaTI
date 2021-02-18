@extends('adminlte::page')

@section('title', 'Nova Permissão')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Nova Permissão</h1> <a href="{{route('permissions.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('permissions.store')}}" method="POST" class="form">
                @csrf
             
                @include('admin.pages.permissions.partials.form')
            </form>
       </div>
   </div>
@stop
