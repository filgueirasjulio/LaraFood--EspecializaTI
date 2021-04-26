@extends('adminlte::page')

@section('title', 'Novo Produto')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Novo Produto</h1> <a href="{{route('products.index')}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" class="form" enctype="multipart/form-data">
                @csrf
             
                @include('admin.pages.products.partials.form')
            </form>
       </div>
   </div>
@stop
