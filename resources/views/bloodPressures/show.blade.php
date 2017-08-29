@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Blood Pressure ID: {{$bloodPressure->id}}</h1>
        <p>Systolic: {{$bloodPressure->systolic}}</p>
        <p>Diastolic: {{$bloodPressure->diastolic}}</p>
        <p>Mouse Id: {{$bloodPressure->mouse_id}}</p>
        <a href="{{ action( 'BloodPressureController@index') }}">
            Go Back
        </a>
    </div>
@endsection