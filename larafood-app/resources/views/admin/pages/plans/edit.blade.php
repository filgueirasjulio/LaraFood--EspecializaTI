@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
    <div class="container">
        <div class="row">
            <h1>Editar Plano {{$plan->name}}</h1> 
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