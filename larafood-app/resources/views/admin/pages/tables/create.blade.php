@extends('adminlte::page')

@section('title', 'Nova Mesa')

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Nova Mesa</h1> <a href="{{route('tables.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('tables.store')}}" method="POST" class="form">
                @csrf
             
                @include('admin.pages.tables.partials.form')
            </form>
       </div>
   </div>
@stop
