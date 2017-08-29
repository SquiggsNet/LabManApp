@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cage ID: {{$cage->id}}</h1>
        <p>Room Number: {{$cage->room_num}}</p>
        <p>Mouse ID: {{$cage->mouse_id}}</p>
        <p>Breeder: {{$cage->breeder}}</p>
        <a href="{{ action( 'CageController@index') }}">
            Go Back
        </a>
    </div>
@endsection