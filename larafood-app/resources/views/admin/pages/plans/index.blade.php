@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Plano</h1> <a href="{{ route('plans.create') }}" class="btn btn-dark"><strong
                    style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> plano</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($plans->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Descrição</th>
                            <th style="width:180px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>
                                    {{ $plan->name }}
                                </td>
                                <td>
                                    R$ {{ number_format($plan->price, 2, ',', '.') }}
                                </td>
                                <td>
                                    {{ $plan->description }}
                                </td>
                                <td>
                                    <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-info" alt="Ver"
                                        title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-warning" alt="Editar"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-secondary"
                                        alt="Detalhes" title="Detalhes"><i class="fas fa-asterisk"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhum plano para ser exibido!</td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filter))
                {!! $plans->appends($filter) !!}
            @else
                {!! $plans !!}
            @endif

        </div>
    </div>
@stop
