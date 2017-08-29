@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <div class="panel panel-default whole">
        <div class="panel-heading text-center">
            <h2>Active Users</h2>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Student ID</th>
                    <th>Edit</th>
                    <th>Disable</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    @if($user->active)
                        <tr>
                            <td>
                                <a href="{{ action( 'UserController@show', ['id' => $user->id]) }}">
                                    {{$user->id}}
                                </a>
                            </td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->student_id}}</td>
                            <td>
                                {{ Form::open(['action' => ['UserController@edit', $user], 'method' => 'get']) }}
                                <button type="submit" >
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['action' => ['UserController@destroy', $user], 'method' => 'delete']) }}
                                <button type="submit" >
                                    <span class="glyphicon glyphicon-ban-circle"></span>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-default" href="{{ action( 'UserController@create') }}">
                Add a new User
            </a>
        </div>
    </div>
    <div class="panel panel-default whole">
        <div class="panel-heading text-center">
            <h2>Inactive Users</h2>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Student ID</th>
                    <th>Edit</th>
                    <th>Enable</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    @if(!$user->active)
                        <tr>
                            <td>
                                <a href="{{ action( 'UserController@show', ['id' => $user->id]) }}">
                                    {{$user->id}}
                                </a>
                            </td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->student_id}}</td>
                            <td>
                                {{ Form::open(['action' => ['UserController@edit', $user], 'method' => 'get']) }}
                                <button type="submit" >
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['action' => ['UserController@destroy', $user], 'method' => 'delete']) }}
                                <button type="submit" >
                                    <span class="glyphicon glyphicon-ok-circle"></span>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection