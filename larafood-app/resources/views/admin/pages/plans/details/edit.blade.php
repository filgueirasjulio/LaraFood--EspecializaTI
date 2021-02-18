@extends('adminlte::page')

@section('title', "Editar - {$plan->name}")

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Editar detalhe do {{ $plan->name }}</h1> <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('details.plan.update', [$plan->url, $detail->id])}}" method="POST">
                @method('PUT')
                @include('admin.pages.plans.details.partials.form')
            </form>
        </div>
    </div>
@stop
