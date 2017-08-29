@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel">
                <div class="panel-heading"><h1>Mouse # {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}</h1></div>
                <div class="panel-body">
                    <div class="text-center">
                        <h3>General Info</h3>
                    </div>
                    <table class="table table-bordered table-striped" id="mouse_data_table" data-toggle="table">
                        <tr>
                            <th>Colony</th>
                            <td>{{ $colony->name }}</td>
                            <th>Father</th>
                            <td>
                                @if(!is_null($mouse->father))
                                    <a href="{{ action( 'MouseController@show', ['id' => $mouse->father]) }}">
                                        {{$mouse->tagPad($mouse->father_record->tags->last()->tag_num)}}
                                        {{$mouse->getGender($mouse->father_record->sex)}}
                                        ({{$mouse->getGeno($mouse->father_record->geno_type_a)}}/{{$mouse->getGeno($mouse->father_record->geno_type_b)}})
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Reserved For</th>
                            <td>
                                @if(isset($user->first_name))
                                    {{ $user->first_name . ' ' . $user->last_name }}
                                @endif
                            </td>
                            <th>Mother One</th>
                            <td>
                                @if(!is_null($mouse->mother_one))
                                    <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_one]) }}">
                                        {{$mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num)}}
                                        {{$mouse->getGender($mouse->mother_one_record->sex)}}
                                        ({{$mouse->getGeno($mouse->mother_one_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_one_record->geno_type_b)}})
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sex</th>
                            <td>{{ $mouse->getGender($mouse->sex) }}</td>
                            <th>Mother Two</th>
                            <td>
                                @if(isset($mouse->mother_two->id))
                                    <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_two]) }}">
                                        {{$mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num)}}
                                        {{$mouse->getGender($mouse->mother_two_record->sex)}}
                                        ({{$mouse->getGeno($mouse->mother_two_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_two_record->geno_type_b)}})
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Genotype</th>
                            <td>
                                @if($mouse->geno_type_a != 'null')
                                    ({{$mouse->getGeno($mouse->geno_type_a)}}/{{$mouse->getGeno($mouse->geno_type_b)}})
                                @endif
                            </td>
                            <th>Mother Three</th>
                            <td>
                                @if(isset($mouse->mother_three->id))
                                    <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_three]) }}">
                                        {{$mouse->tagPad($mouse->mother_three_record->tags->last()->tag_num)}}
                                        {{$mouse->getGender($mouse->mother_three_record->sex)}}
                                        ({{$mouse->getGeno($mouse->mother_three_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_three_record->geno_type_b)}})
                                    </a>
                                @endif
                            </td>
                        </tr>
                        {{--<tr>--}}
                            <th>Birth Date</th>
                            <td>
                                @if(!is_null($mouse->birth_date))
                                    {{$mouse->birth_date}}
                                @endif
                            </td>
                            <th>Wean Date</th>
                            <td>
                                @if(!is_null($mouse->wean_date))
                                    {{$mouse->wean_date}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{$mouse->end_date}}</td>
                            <th>Sick Report</th>
                            <td>@if($mouse->sick_report) Yes @else No @endif</td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <h3>Surgery & Treatment</h3>
                    </div>
                    <table class="table table-bordered table-striped" id="mouse_surgery_table" data-toggle="table">
                        <tr>
                            <th>Treatments</th>
                            <td>
                                @foreach($mouse->treatments as $treatment)
                                    {{ $treatment->title . ' @ ' . $treatment->pivot->dosage . ' (mg/kg/day)'}}<br/>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Experiment Use</th>
                            <td>
                                @foreach($mouse->experiments as $experiment)
                                    {{ $experiment->title}}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Surgery</th>
                            <td>
                                @foreach($surgeries as $surgery)
                                    @foreach($surgery->mice as $sm)
                                        @if($sm->id == $mouse->id)
                                            {{ $surgery->title }}
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <h3>Comments</h3>
                    </div>
                    <table class="table table-bordered table-striped" id="mouse_comment_table" data-toggle="table">
                        <tr>
                            <th>Comment</th>
                            <th>Submitted By</th>
                            <th>Date</th>
                        </tr>
                        @foreach($mouse->comments as $comments)
                            <tr>
                                <td>{{ $comments->comment }}</td>
                                <td>{{ $mouse->getUserName($comments->user_id) }}</td>
                                <td>{{ $comments->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ action( 'MouseController@index') }}">
            Go Back
        </a>
    </div>
@endsection