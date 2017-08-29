@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <h1 class="row-centered"> Laboratory Management System</h1>

            <div class="half">
                <div class="panel panel-default whole">
                    <div class="panel-heading"><a href="{{ url('/colonies') }}"><h3>Test Subject Management</h3></a></div>
                    <div class="panel-body">

                        @foreach ($colonies as $colony)
                            @if($colony->active)
                                <a class="btn btn-lg btn-block"
                                   href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                                    {{$colony->name}}
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="panel panel-default whole">
                    <div class="panel-heading"><a href="{{ url('/surgeries') }}"><h3>Surgeries or Procedures</h3></a></div>
                    <div class="panel-body">

                        @foreach ($surgeries as $surgery)
                            <a class="btn btn-lg btn-block" href="{{ action( 'SurgeryController@show', ['id' => $surgery->id]) }}" role="button">
                                {{ $surgery->title }}
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="panel panel-default half last">
                <div class="panel-heading"><a href="{{ url('/storages') }}"><h3>Storage Facilities</h3></a></div>
                <div class="panel-body">
                    @foreach ($freezers as $feezer)
                        <a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $feezer->id]) }}" role="button">
                                Primary Storage Type {{$feezer->identifier}}
                        </a>
                    @endforeach
                    @foreach ($histologies as $histologie)
                        <a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $histologie->id]) }}" role="button">
                            Secondary Storage Type {{$histologie->identifier}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
