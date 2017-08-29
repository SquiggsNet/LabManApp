@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Colony Management</h1>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Active Colonies</h4></div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                        <thead>
                        <tr>
                            <th>Colony</th>
                            <th>In House</th>
                            <th>Active Mice</th>
                            <th>Males</th>
                            <th>Females</th>
                            <th>Edit</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colonies as $colony)
                            @if($colony->active)
                                <?php $male_count = 0; $female_count = 0; ?>
                                @foreach($colony->mice as $mouse)
                                    @if($mouse->sex == 1)
                                        <?php $male_count++;?>
                                    @else
                                        <?php $female_count++;?>
                                    @endif
                                @endforeach
                                <tr>
                                    {{--Colony Name--}}
                                    <td>
                                        {{ $colony->name }}
                                    </td>
                                    {{--In House--}}
                                    <td>
                                        @if($colony->external) No @else Yes @endif
                                    </td>
                                    {{--Active Mice--}}
                                    <td>
                                        {{ count($colony->mice) }}
                                    </td>
                                    {{--Males--}}
                                    <td>
                                        {{ $male_count }}
                                    </td>
                                    {{--Females--}}
                                    <td>
                                        {{ $female_count }}
                                    </td>
                                    {{--Edit--}}
                                    <td>
                                        {{ Form::open(['action' => ['ColonyController@edit', $colony], 'method' => 'get']) }}
                                        <button type="submit" >
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{ Form::open(['action' => ['ColonyController@destroy', $colony], 'method' => 'delete']) }}
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
                    {!! Form::open(['action' => 'ColonyController@store' ]) !!}
                    <div class="form-group col-md-7 col-lg-7">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name',null ,['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group col-md-3 col-lg-3">
                        {!! Form::submit('Add Colony',['class'=>'btn btn-default top-buffer']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Inactive Colonies</h4></div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                        <thead>
                        <tr>
                            <th>Colony</th>
                            <th>Active Mice</th>
                            <th>Males</th>
                            <th>Females</th>
                            <th>Activate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colonies as $colony)
                            @if(!$colony->active)
                                <?php $male_count = 0; $female_count = 0; ?>
                                @foreach($colony->mice as $mouse)
                                    @if($mouse->sex == 1)
                                        <?php $male_count++;?>
                                    @else
                                        <?php $female_count++;?>
                                    @endif
                                @endforeach
                                <tr>
                                    {{--Colony Name--}}
                                    <td>
                                        {{ $colony->name }}
                                    </td>
                                    {{--Active Mice--}}
                                    <td>
                                        {{ count($colony->mice) }}
                                    </td>
                                    {{--Males--}}
                                    <td>
                                        {{ $male_count }}
                                    </td>
                                    {{--Females--}}
                                    <td>
                                        {{ $female_count }}
                                    </td>
                                    {{--Edit--}}
                                    <td>
                                        {{ Form::open(['action' => ['ColonyController@destroy', $colony], 'method' => 'delete']) }}
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
    </div>
@endsection