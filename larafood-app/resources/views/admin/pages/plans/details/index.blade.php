@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')

    <div class="container">
        <div class="row justify-content-between">
            <h1>Detalhes - Plano {{ $plan->name }}</h1> <a href="{{ route('plans.index') }}" class="btn btn-dark"><strong
                    style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <form action="{{ route('plans.details.search', $plan->url) }}" method="POST" class="form form-inline">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                </form>
                <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark"><strong
                        style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> detalhe</a>
            </div>
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($details->count()) 
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th width="115" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>
                                    {{ $detail->name }}
                                </td>
                                <td class="d-flex justify-content-between">
                                    <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}"
                                        class="btn btn-warning" alt="Editar" title="Editar"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" alt="Remover" title="Remover">
                                            <strong style="font-size:16px;padding-right:5px;"><i
                                                    class="fas fa-trash-alt"></i></strong>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td style="font-size:18px">Nenhum detalhe para ser exibido!</td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif
        </div>
    </div>
@stop
