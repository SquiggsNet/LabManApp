@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tissue ID: {{$tissue->id}}</h1>
        <p>Name: {{$tissue->name}}</p>
        <a href="{{ action( 'TissueController@index') }}">
            Go Back
        </a>
    </div>
@endsection