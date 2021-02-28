@extends('adminlte::page')

@section('title', "Editar - {$category->name}")

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Editar {{$category->name}}</h1> <a href="{{route('categories.index')}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('categories.update', $category->id)}}" method="POST" class="form">
                @csrf
                @method('PUT')

                @include('admin.pages.categories.partials.form')
            </form>
       </div>
   </div>
@stop