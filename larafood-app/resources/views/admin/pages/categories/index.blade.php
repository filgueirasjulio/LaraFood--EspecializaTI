@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Categorias</h1> <a href="{{ route('categories.create') }}" class="btn btn-sm btn-dark"><strong
                    style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> Categoria</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('categories.search') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                    <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                        <a href="{{route('categories.index')}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                @endif
            </div>
        </div>
        <div class="card-body table-responsive p-0">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($categories->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th style="width:180px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    {{ $category->description }}
                                </td>
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info" alt="Ver"
                                        title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning" alt="Editar"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhum usuário para ser exibido!</td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filter))
                {!! $categories->appends($filter) !!}
            @else
                {!! $categories !!}
            @endif

        </div>
    </div>
@stop
