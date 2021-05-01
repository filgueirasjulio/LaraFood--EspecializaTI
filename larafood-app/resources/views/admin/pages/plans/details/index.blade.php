@extends('adminlte::page')

@section('title', "Detalhes - {$plan->name}")

@section('content_header')
    <div class="d-flex flex-row-reverse">
        <a href="{{ route('plans.index') }}" class="btn btn-sm btn-dark" style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></a>
    </div>

    <div class="container-fluid" style="margin-top:15px;">
        <div class="row justify-content-between">
            <h1>Detalhes do {{ $plan->name }}</h1> <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark"><strong
                style="font-size:16px;padding-right:5px;"><i class="fas fa-plus"></i></strong> detalhe</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('plans.details.search', $plan->url) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                    <a href="{{route('details.plan.index', $plan->url)}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                </strong> 
                <hr>
            @endif
            </div>
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($details->count()) 
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th width="115">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>
                                    {{ $detail->name }}
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}"
                                        class="btn btn-sm btn-warning" alt="Editar" title="Editar" style="margin-right: 3px;"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" alt="Remover" title="Remover">
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
