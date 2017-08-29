@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blood Pressures</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Systolic</th>
            <th>Diastolic</th>
            <th>Mouse ID</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($bloodPressures as $bloodPressure)
        <tr>
            <td>
                <a href="{{ action( 'BloodPressureController@show', ['id' => $bloodPressure->id]) }}">
                    {{$bloodPressure->id}}
                </a>
            </td>
            <td>{{$bloodPressure->systolic}}</td>
            <td>{{$bloodPressure->diastolic}}</td>
            <td>{{$bloodPressure->mouse_id}}</td>
            <td>
                {{ Form::open(['action' => ['BloodPressureController@edit', $bloodPressure], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['BloodPressureController@destroy', $bloodPressure], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'BloodPressureController@create') }}">
        Create a New Blood Pressure
    </a>
</div>
@endsection