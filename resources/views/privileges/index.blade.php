@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Privileges</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($privileges as $privilege)
        <tr>
            <td>
                <a href="{{ action( 'PrivilegeController@show', ['id' => $privilege->id]) }}">
                    {{$privilege->id}}
                </a>
            </td>
            <td>{{$privilege->name}}</td>
            <td>
                {{ Form::open(['action' => ['PrivilegeController@edit', $privilege], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['PrivilegeController@destroy', $privilege], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'PrivilegeController@create') }}">
        Create a New Privelege
    </a>
</div>
@endsection