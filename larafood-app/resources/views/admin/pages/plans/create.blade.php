@extends('adminlte::page')

@section('title', 'Novo Plano')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Novo Plano</h1>
        </div>
    </div>
@stop

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('plans.store')}}" method="POST" class="form">
                @csrf
             
                @include('admin.pages.plans.partials.form')
            </form>
       </div>
   </div>
@stop
