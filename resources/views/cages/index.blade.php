@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="row-centered">Breeder Cages</h1>
            <a id="create_cage" class="btn btn-default pull-right btn-block sixth bottom-buffer last"
               href="{{ action( 'CageController@create') }}">
                Create a New Cage
            </a>
        @foreach($cages as $cage)
            <div class="panel panel-default whole">
                <div class="panel-heading">
                    <h3>Cage: {{$cage->room_num}}</h3>
                    {{ Form::open(['action' => ['CageController@destroy', $cage->id],
                    'method' => 'delete', 'onsubmit' => 'return confirmDelete()']) }}
                    <button type="submit" class="btn btn-default pull-right sixth bottom-buffer last" >
                        Delete Cage
                    </button>
                    {{ Form::close() }}
                </div>
                <div class="panel-body">
                <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                    <thead>
                    <tr>
                        <th></th>
                        <th data-field="tag" >Tag</th>
                        <th>Strain</th>
                        <th>Genotype</th>
                        <th>DOB</th>
                        <th>Age</th>
                        <th>Weight</th>
                        <th>Reserved For</th>
                        <th>Comments</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tagged_mice as $mouse)
                        @if($mouse->id == $cage->male or $mouse->id == $cage->female_one
                            or$mouse->id == $cage->female_two or$mouse->id == $cage->female_three)
                            @if(isset($mouse->tags->last()->tag_num))
                                @if($mouse->sex == "1")
                                    <?php $class = "info" ?>
                                @elseif($mouse->sex == "0" and !is_null($mouse->sex))
                                    <?php $class = "danger" ?>
                                @else
                                    <?php $class = "" ?>
                                @endif
                                @if($mouse->sick_report)
                                    <?php $id = "report" ?>
                                @else
                                    <?php $id = "no_report" ?>
                                @endif
                                <tr class="{{ $class }}" id="{{ $id }}">
                                    <td>
                                        <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $mouse->id }}"/>
                                    </td>
                                    <td>
                                        <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                                            {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ action( 'ColonyController@show', ['id' => $mouse->colony->id]) }}">
                                            {{$mouse->colony->name}}
                                        </a>
                                    </td>
                                    <td>{{ $mouse->genoFormat($mouse->geno_type_a, $mouse->geno_type_b) }}</td>
                                    <td>{{ $mouse->showDate($mouse->birth_date) }}</td>
                                    <td>{{$mouse->getAge($mouse->birth_date)}}</td>
                                    <td>
                                        @if(!empty($mouse->weights->last()->weight))
                                            {{$mouse->weights->last()->weight . 'g'}}
                                        @endif
                                    </td>
                                    <td>{{$mouse->users}}</td>
                                    <td>
                                        <?php $i=1; $len = count($mouse->comments); ?>
                                        @foreach($mouse->comments as $comments)
                                            @if($i == $len)
                                                {{ $comments->comment }}
                                            @endif
                                            <?php $i++; ?>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ Form::open(['action' => ['MouseController@edit', $mouse], 'method' => 'get']) }}
                                        <button type="submit" >
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{ Form::open(['action' => ['MouseController@destroy', $mouse], 'method' => 'delete']) }}
                                        <button type="submit" >
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        @endforeach
</div>
@endsection