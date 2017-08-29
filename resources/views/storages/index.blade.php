@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="panel panel-default third-x2">
                <div class="panel-heading"><h3>Storage</h3></div>
                <div class="panel-body">
                    @foreach ($freezers as $feezer)
                        <a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $feezer->id]) }}" role="button">
                            (-80&deg;C) Freezer {{$feezer->identifier}}
                        </a>
                    @endforeach
                    @foreach ($histologies as $histologie)
                        <a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $histologie->id]) }}" role="button">
                            Histology {{$histologie->identifier}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection