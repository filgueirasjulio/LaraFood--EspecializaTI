@extends('adminlte::page')

@section('title', "Editar - {$product->name}")

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Editar {{$product->name}}</h1> <a href="{{route('products.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('products.update', $product->id)}}" method="POST" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.products.partials.form')
            </form>
       </div>
   </div>
@stop