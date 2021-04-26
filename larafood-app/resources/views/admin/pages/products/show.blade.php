@extends('adminlte::page')

@section('title', "Productos
 - {$product->name}")

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>{{$product->name}}</h1> <a href="{{route('plans.index')}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul style="list-style:none;">
                <li style="padding-bottom:10px;">
                <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width: 90px;">
                </li>
                <li style="padding-bottom:10px;">
                    <strong>Título: </strong> {{$product->title}}
                </li>
                <li style="padding-bottom:10px;">
                    <strong>Preço: </strong> {{$product->price}}
                </li>
                <li style="padding-bottom:10px;">
                    <strong>Descrição: </strong> {{$product->description}}
                </li>
                <li style="padding-bottom:10px;">
                    <strong>Flag: </strong> {{$product->flag}}
                </li>
                <li>
                    @include('admin.includes.alerts')
                    <form action="{{route('products.destroy', $product->id)}}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"  alt="Remover">
                            <strong style="font-size:16px;padding-right:5px;"><i class="fas fa-trash-alt"></i></strong>  Deletar 
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@stop
