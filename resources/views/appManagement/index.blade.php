@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Application</h1>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>User Management</h4></div>
                    <div class="panel-body">
                        <h5>Active Users</h5>
                        <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID No.</th>
                                    <th>Phone No.</th>
                                    <th>E-Mail</th>
                                    <th>Administrator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    @if($user->active)
                                        <tr>
                                            <td>{{ $user->getFullName() }}</td>
                                            <td>{{ $user->student_id }}</td>
                                            <td>{{ $user->formatPhone() }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->admin)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-default" href="{{ action( 'UserController@index') }}">
                            All Users
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Test Subject Management</h4></div>
                    <div class="panel-body">
                        <h5>Active Groups</h5>
                        <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                            <thead>
                            <tr>
                                <th>Group</th>
                                <th>Active Mice</th>
                                <th>Males</th>
                                <th>Females</th>
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
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-default" href="{{ action( 'ColonyController@create') }}"> All Colonies </a>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Surgery Management</h4></div>
                    <div class="panel-body">
                        <div class="col-lg-4">

                            <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                                <thead>
                                    <tr>
                                        <th>Tissues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < $total_rows; $i++)
                                        <tr>
                                            <td>
                                                @if(!empty($tissues[$i]))
                                                    {{ $tissues[$i]->name }}
                                                @else
                                                    <br>
                                                @endif
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            <a class="btn btn-default" href="{{ action( 'TissueController@index') }}">
                                All Tissues
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                                <thead>
                                <tr>
                                    <th>Treatments</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < $total_rows; $i++)
                                    <tr>
                                        <td>
                                            @if(!empty($treatments[$i]))
                                                {{ $treatments[$i]->title }}
                                            @else
                                                <br>
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                            <a class="btn btn-default" href="{{ action( 'TreatmentController@index') }}">
                                All Treatments
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                                <thead>
                                <tr>
                                    <th>Experiments</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < $total_rows; $i++)
                                    <tr>
                                        <td>
                                            @if(!empty($experiments[$i]))
                                                {{ $experiments[$i]->title }}
                                            @else
                                                <br>
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                            <a class="btn btn-default" href="{{ action( 'ExperimentController@index') }}">
                                All Experiments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Storage Facility Management</h4></div>
                    <div class="panel-body">

                        <div class="panel-body">
                            <div class="col-lg-6">

                                <table class="table table-bordered table-striped" id="freezer_table" data-toggle="table" >
                                    <thead>
                                    <tr>
                                        <th>Freezer</th>
                                        <th>Number of Compartments</th>
                                        <th>Number of Shelves</th>
                                        <th>Number of Boxes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($freezers as $freezer)
                                        <tr>
                                            <td>
                                                {{$freezer->identifier}}
                                            </td>
                                            <td>
                                                {{$freezer->number_of_compartments($freezer)}}
                                            </td>
                                            <td>
                                                {{$freezer->number_of_shelves($freezer)}}
                                            </td>
                                            <td>
                                                {{$freezer->number_of_boxes($freezer)}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <a class="btn btn-default" href="{{ action( 'TissueController@index') }}">
                                    All Freezers
                                </a>
                            </div>

                            <div class="col-lg-6">
                                <table class="table table-bordered table-striped" id="histology_table" data-toggle="table" >
                                    <thead>
                                    <tr>
                                        <th>Histology</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($histologies as $histology)
                                        <tr>
                                            <td>
                                                {{$histology->identifier}}
                                             </td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                 </table>
                                 <a class="btn btn-default" href="{{ action( 'TreatmentController@index') }}">
                                    All Histologies
                                </a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Export Data</h4></div>
                    <div class="panel-body">
                        <a class="btn btn-default" href="{{ action( 'AppManagementController@create') }}">
                            Begin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection