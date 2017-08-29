@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User ID: {{$user->id}}</h1>
        <p>First Name: {{$user->first_name}}</p>
        <p>Last Name: {{$user->last_name}}</p>
        <p>Email (User Name): {{$user->email}}</p>
        <p>Phone: {{$user->phone}}</p>
        <p>Student ID: {{$user->student_id}}</p>
        <a href="{{ action( 'UserController@index') }}">
            Go Back
        </a>
    </div>
@endsection