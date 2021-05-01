@extends('adminlte::page')

@section('title', 'Adicionar detalhe')

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Adicionar detalhe ao plano {{ $plan->name }}</h1> <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('details.plan.store', $plan->url)}}" method="POST">
                @include('admin.pages.plans.details.partials.form')
            </form>
        </div>
    </div>
@stop
