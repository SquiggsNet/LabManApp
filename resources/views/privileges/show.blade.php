@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Privilege ID: {{$privilege->id}}</h1>
        <p>Description: {{$privilege->name}}</p>
        <a href="{{ action( 'PrivilegeController@index') }}">
            Go Back
        </a>
    </div>
@endsection