@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel">
                <div class="panel-heading"><h1>Surgery: {{ $surgery->title }}</h1></div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="mouse_data_table" data-toggle="table">
                        <tr>
                            <th>Surgeon</th>
                            <td>{{$surgery->user->getFullName()}}</td>
                        </tr>
                        <tr>
                            <th>Scheduled Date</th>
                            <td>{{$surgery->scheduled_date}}</td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                        <thead>
                        <tr>
                            <th data-field="tag" >Tag</th>
                            <th>Strain</th>
                            <th>Geno Type</th>
                            <th>Age</th>
                            <th>Weight</th>
                            <th>Treatment</th>
                            <th>Dosage(mg/kg/day)</th>
                            <th>Experimental Use</th>
                            <th>End User</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $m_num = 0;?>
                        @foreach ($surgery->mice as $mouse)
                            @if(isset($mouse->tags->last()->tag_num))
                                @if($mouse->sex == 'True')
                                    <?php $class = "info" ?>
                                @else
                                    <?php $class = "danger" ?>
                                @endif
                                @if($mouse->sick_report)
                                    <?php $id = "report" ?>
                                @else
                                    <?php $id = "no_report" ?>
                                @endif
                                <tr class="{{ $class }}" id="{{ $id }}">
                                    {{--Mouse Tags--}}
                                    <td>
                                        <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                                            {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                                        </a>
                                    </td>
                                    {{--Strain--}}
                                    <td>
                                        <a href="{{ action( 'ColonyController@show', ['id' => $mouse->colony->id]) }}">
                                            {{$mouse->colony->name}}
                                        </a>
                                    </td>
                                    {{--GenoType--}}
                                    <td>
                                        @if(isset($mouse->geno_type_a))
                                            {{ $mouse->genoFormat($mouse->geno_type_a, $mouse->geno_type_b) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    {{--Age--}}
                                    <td>
                                        {{$mouse->getAge($mouse->birth_date)}}
                                    </td>
                                    {{--Current Weight--}}
                                    <td>
                                        @if(isset($mouse->weights->last()->weight))
                                            {{$mouse->weights->last()->weight}}g
                                        @endif
                                    </td>
                                    {{--Treatment--}}
                                    <td class="col-lg-2">
                                        @foreach($mouse->treatments as $treat)
                                            {{ $treat->title }} <br/>
                                        @endforeach
                                    </td>
                                    {{--Dosage--}}
                                    <td class="col-lg-1">
                                        @foreach($mouse->treatments as $treat)
                                            {{$treat->pivot->dosage}} <br/>
                                        @endforeach
                                    </td>
                                    {{--Experimental Use--}}
                                    <td class="col-lg-2">
                                        @foreach($mouse->experiments as $experiment)
                                            {{ $experiment->title }} <br/>
                                        @endforeach
                                    </td>
                                    {{--End User--}}
                                    <td>
                                        {{ $mouse->getUserName($mouse->reserved_for) }}
                                    </td>
                                </tr>
                                <?php $m_num++; ?>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ action( 'SurgeryController@index') }}">
            Go Back
        </a>
    </div>
@endsection