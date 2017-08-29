@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Treatment Management</h1>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Active Treatments</h4></div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($treatments as $treatment)
                            @if($treatment->active)
                                <tr>
                                    {{--Tissue Name--}}
                                    <td>
                                        {{ $treatment->title }}
                                    </td>
                                    {{--Edit--}}
                                    <td>
                                        {{ Form::open(['action' => ['TreatmentController@edit', $treatment], 'method' => 'get']) }}
                                        <button type="submit" >
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                        {{ Form::close() }}
                                    </td>
                                    {{--Deactivate--}}
                                    <td>
                                        {{ Form::open(['action' => ['TreatmentController@destroy', $treatment], 'method' => 'delete']) }}
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
                    {!! Form::open(['action' => 'TreatmentController@store' ]) !!}
                    <div class="form-group col-md-7 col-lg-7">
                        {!! Form::label('title', 'Name') !!}
                        {!! Form::text('title',null ,['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group col-md-3 col-lg-3">
                        {!! Form::submit('Add Treatment',['class'=>'btn btn-default top-buffer']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Inactive Treatments</h4></div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Activate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($treatments as $treatment)
                            @if(!$treatment->active)
                                <tr>
                                    {{--Colony Name--}}
                                    <td>
                                        {{ $treatment->title }}
                                    </td>
                                    {{--Edit--}}
                                    <td>
                                        {{ Form::open(['action' => ['TreatmentController@destroy', $treatment], 'method' => 'delete']) }}
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
        <a href="{{ action( 'AppManagementController@index') }}">
            Go Back
        </a>
    </div>
@endsection