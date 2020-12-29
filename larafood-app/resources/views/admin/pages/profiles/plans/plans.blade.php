@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <div class="d-flex flex-row-reverse">
        <a href="{{route('profiles.index')}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
    </div>
    
    <div class="container" style="margin-top:15px;">
        <div class="row justify-content-between">
            <h1>Planos de {{$profile->name}} </h1> <a href="{{ route('profiles.plans.available', $profile->id) }}" class="btn btn-dark"><strong
                    style="font-size:15px;padding-right:5px;"><i class="fas fa-plus"></i></strong> Plano</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('profiles.plans.search', $profile->id) }}" method="POST"  class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                    <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                        <a href="{{route('profiles.plans', $profile->id)}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                    <hr>
                @endif
            </div>
        </div>
        <div class="card-body table-responsive">
        
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($plans->count())
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>
                                    {{ $plan->name }}
                                </td>
                                <td>
                                    <a href="{{ route('profiles.plans.detach', [$profile->id, $plan->id]) }}" class="btn btn-info" alt="Desvincular"
                                        title="Ver">Desvincular<a>
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
