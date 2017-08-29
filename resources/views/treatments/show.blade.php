@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cage ID: {{$treatment->id}}</h1>
        <p>Room Number: {{$treatment->title}}</p>
        <p>Mouse ID: {{$treatment->drug_amount}} mg/kg/day</p>
        <p>Breeder: {{$treatment->mouse_id}}</p>
        <a href="{{ action( 'TreatmentController@index') }}">
            Go Back
        </a>
    </div>
@endsection