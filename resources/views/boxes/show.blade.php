@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="row-centered"> Box #{{$box->box}}</h1>
        <div class="panel panel-default whole">
            <div class="panel-heading">
                <h3>Location</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Freezer {{$box->shelf->compartment->storage->identifier}}</td>
                            <td>{{$box->shelf->compartment->description}} Compartment</td>
                        </tr>
                        <tr>
                            <td>{{$box->shelf->description}} Shelf</td>
                            <td>{{$box->mouse_storages->count()}}/{{$box->capacity}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default whole">
            <div class="panel-heading">
                <h3>Contents</h3>
            </div>
            <div class="panel-body">
                <div class="whole bottom-buffer">
                    {{ Form::open(['action' => ['BoxController@showFiltered', $box], 'method' => 'POST']) }}
                    {{--{!! Form::open(['action' => 'BoxController@showFiltered', $box->id ]) !!}--}}
                    <div class="quarter">
                        <label class="form-label" >Tissue Region</label>
                        <select name="tissue_select" id="tissue_select" class="form-control">
                            {{--<option selected="{{$tissue_select}}"></option>--}}
                            <option value="0">All</option>
                            @foreach($tissues as $tissue)
                                @if($tissue_select == $tissue->id )
                                   <option selected="selected" value="{{ $tissue->id }}">
                                @else
                                    <option value="{{ $tissue->id }}">
                                @endif
                                    {{$tissue->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="quarter">
                        <label class="form-label" >Strain</label>
                        <select name="strain_select" id="strain_select" class="form-control">
                            <option value="0">All</option>
                            @foreach($strains as $strain)
                                @if($strain_select == $strain->id )
                                    <option selected="selected" value="{{ $strain->id }}">
                                @else
                                    <option value="{{ $strain->id }}">
                                @endif
                                    {{$strain->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="quarter">
                        <label class="form-label" >Genotype</label>
                        <select name="geno_select" id="geno_select" class="form-control">
                            <option value="0">All</option>
                            @if($geno_select == "1" )
                                <option selected="selected" value="1">
                            @else
                                <option value="1">
                            @endif
                                (+/+)
                            </option>
                            @if($geno_select == "2" )
                                <option selected="selected" value="2">
                            @else
                                <option value="2">
                            @endif
                                (+/-)
                            </option>
                            @if($geno_select == "3" )
                                <option selected="selected" value="3">
                            @else
                                <option value="3">
                            @endif
                                (-/-)
                            </option>
                        </select>
                    </div>
                    <div class="quarter last">
                        <label class="form-label" >Treatment</label>
                        <select name="treatment_select" id="treatment_select" class="form-control">
                            <option value="0">All</option>
                            @foreach($treatments as $treatment)
                                @if($treatment_select == $treatment->id )
                                    <option selected="selected" value="{{ $treatment->id }}">
                                @else
                                    <option value="{{ $treatment->id }}">
                                @endif
                                    {{$treatment->title}}
                                </option>

                            @endforeach
                            <option value="untreated">Untreated</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    {!! Form::submit('Narrow Results',['class'=>'btn btn-default pull-right bottom-buffer']) !!}
                </div>
                {{ Form::hidden('sort_order', $sort_order) }}
                {{ Form::hidden('sort_by', $sort_by) }}
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
                            <input type="submit" name="sort_clicked" value="Tissue Region" class='btn-link'>
                        </th>
                        <th>
                            <input type="submit" name="sort_clicked" value="Strain" class='btn-link'>
                        </th>
                        <th>
                            Genotype
                            {{--<input type="submit" name="sort_clicked" value="Genotype" class='btn-link'>--}}
                        </th>
                        <th>
                            Treatment
                            {{--<input type="submit" name="sort_clicked" value="Treatment" class='btn-link'>--}}
                        </th>
                        <th>
                            Tag#
                            {{--<input type="submit" name="sort_clicked" value="Tag#" class='btn-link'>--}}
                        </th>
                        <th>
                            <input type="submit" name="sort_clicked" value="Isolation Date" class='btn-link'>
                        </th>
                        <th>
                            <input type="submit" name="sort_clicked" value="Isolated By" class='btn-link'>
                        </th>
                    </tr>
                    </thead>
                    {!! Form::close() !!}
                    <tbody>
                    {{--@foreach ($tissues->sortByDesc('extraction_date') as $tissue)--}}
                    {{--@foreach ($storedTissues->$sort_order($sort_by)as $tissue)--}}
                        @foreach ($storedTissues as $tissue)
                    {{--@foreach ($storedTissues->$sort_order('tissue.name')as $tissue)--}}
                        <tr>
                            <td>
                                <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $box->id }}"/>
                            </td>
                            <td>{{$tissue->tissue->name}}</td>
                            <td>{{$tissue->mouse->colony->name}}</td>
                            <td>{{$tissue->mouse->genoFormat($tissue->mouse->geno_type_a, $tissue->mouse->geno_type_b)}}</td>
                            @if(!$tissue->mouse->treatments->isEmpty())
                                <td>
                                @foreach ($tissue->mouse->treatments as $treatment)
                                    {{$treatment->title}}
                                @endforeach
                                </td>
                            @else
                                <td>N/A</td>
                            @endif
                            <td>{{ $tissue->mouse->tagPad($tissue->mouse->tags->last()->tag_num) }}</td>
                            <td>{{$tissue->extraction_date}}</td>
                            <td>{{$tissue->user->first_name . ' ' . $tissue->user->last_name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection