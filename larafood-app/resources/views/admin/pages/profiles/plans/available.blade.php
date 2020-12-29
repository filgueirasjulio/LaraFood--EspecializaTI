@extends('adminlte::page')

@section('title', 'Planos disponíveis')

@section('content_header')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Planos disponíveis para {{$profile->name}} </h1> <a href="{{route('profiles.plans', $profile->id )}}" class="btn btn-sm btn-dark"><strong style="font-size:16px;padding-right:5px;"><i class="fas fa-backward"></i></strong></a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form action="{{ route('profiles.plans.available.search', $profile->id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="filter" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                </form>
                @if($filter && $filter != '')
                    <strong style="font-size:16px; margin-left:20px; margin-top:7px;"> Desfazer busca 
                        <a href="{{route('profiles.plans.available', $profile->id)}}"><i class="fas fa-sync-alt" style="padding-left:5px;"></i></a>
                    </strong> 
                @endif
            </div>
        </div>
        <div class="card-body table-responsive">
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                @if ($plans->count())
                    <thead>
                        <tr>
                           <th width="50px">#</th>
                           <th>Nome<th>
                    </thead>
                    <tbody>
                        <form action="{{ route('profiles.plans.attach', $profile->id) }}" method="POST">
                            @csrf
                            @foreach ($plans as $plan)
                            <tr>
                                <td>
                                    <input type="checkbox" name="plans[]" value="{{ $plan->id }}">
                                </td>
                                <td>
                                    {{ $plan->name }}
                               </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="500">
                                    <button type="submit" class="btn btn-dark">
                                        Vincular
                                    </button>
                                </td>
                            </tr>
                        </form>
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
