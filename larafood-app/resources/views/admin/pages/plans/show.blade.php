@extends('adminlte::page')

@section('title', 'Plano')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Detalhes - Plano {{$plan->name}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul style="list-style:none;">
                <li style="padding-bottom:10px;">
                    <strong>Nome: </strong> {{ $plan->name }}
                </li>
                <li style="padding-bottom:10px;">
                    <strong>URL: </strong> {{$plan->url}}
                </li>
                <li style="padding-bottom:10px;">
                    <strong>Preço: </strong> R$ {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li style="padding-bottom:10px;">
                    <strong>Descrição: </strong> {{$plan->description}}
                </li>
                <li>
                    <form action="{{route('plans.destroy', $plan->url)}}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <strong style="font-size:16px;padding-right:5px;"><i class="fas fa-trash-alt"></i></strong>  Deletar 
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@stop
