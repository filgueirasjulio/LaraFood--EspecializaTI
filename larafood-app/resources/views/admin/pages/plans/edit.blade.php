@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Editar Plano {{$plan->name}}</h1> <a href="{{route('plans.index')}}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>  
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('plans.update', $plan->url)}}" method="POST" class="form">
                @csrf
                @method('PUT')

                @include('admin.pages.plans.partials.form')
            </form>
       </div>
   </div>
@stop