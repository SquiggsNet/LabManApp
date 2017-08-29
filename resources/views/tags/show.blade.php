@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tag ID: {{$tag->id}}</h1>
        <p>Tag Number: {{$tag->tag_num}}</p>
        <p>Lost Tag: {{$tag->lost_tag}}</p>
        <a href="{{ action( 'TagController@index') }}">
            Go Back
        </a>
    </div>
@endsection