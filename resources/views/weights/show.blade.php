@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Weight ID: {{$weight->id}}</h1>
        <p>Weight: {{$weight->weight}}</p>
        <p>Mouse ID: {{$weight->mouse_id}}</p>
        <a href="{{ action( 'WeightController@index') }}">
            Go Back
        </a>
    </div>
@endsection