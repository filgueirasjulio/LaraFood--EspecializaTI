@extends('adminlte::page')

@section('title', 'Nova categoria')

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Nova Categoria</h1> <a href="{{route('categories.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('categories.store')}}" method="POST" class="form">
                @csrf
             
                @include('admin.pages.categories.partials.form')
            </form>
       </div>
   </div>
@stop
