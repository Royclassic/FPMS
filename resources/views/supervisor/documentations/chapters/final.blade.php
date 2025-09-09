@if($doc->final_documentation!==null)
    <div class="list-group-item media">
        <div class="checkbox pull-left">
            <label>
                <input type="checkbox" value="">
                <i class="input-helper"></i>
            </label>
        </div>
        @if($doc->comment==null)
            <div class="pull-right">
                <div class="actions dropdown">
                    <a href="" data-toggle="dropdown" aria-expanded="true">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="#" onclick="return assessFinal('{{$doc->id}}')">Assess</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        <div class="media-body">
            <div class="lgi-heading f-20 f-500">
                {{$doc->final_documentation}}
                <span>
                    <a href="{{URL::to('documentations/'.$doc->student->user->email.'/'.$doc->final_documentation)}}" target="_blank">
                        <button class="btn btn-success btn-xs">
                            <i class="zmdi zmdi-eye">View</i></button>
                    </a>
{{--                    <a ><button class="btn btn-info btn-xs"><i class="zmdi zmdi-check-all">Plagiarism Check</i></button></a>--}}
                </span>
            </div>
            @if($doc->comment!==null)
                <div class="list-group-item media" style="background-color: inherit!important;">
                    <div style="padding-left: 15px;">
                    </div>
                    <div class="pull-left">
                        @if(Auth::user()->image==!null)
                            <img class="lgi-img" src="{{url('profile/'.Auth::user()->image)}}" alt="">
                        @else
                            <img class="lgi-img" src="{{URL::to('default-profile.jpg')}}" alt="">
                        @endif
                    </div>

                    <div class="pull-right">
                        <div class="actions dropdown">
                            <a href="" data-toggle="dropdown" aria-expanded="true">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="#" onclick="return editFinalAssessment('{{$doc->id}}')">Edit</a>
                                </li>
                                <li>
                                    <a href="#" onclick="return finalDelete('{{$doc->created_at}}')">Delete</a>

                                </li>
                            </ul>
                        </div>
                        <form method="POST" action="{{route('supervisor.docs.final.delete',$doc->id)}}"
                              id="{{$doc->created_at}}" style="display: none">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$doc->id}}" name="id">
                        </form>
                    </div>

                    <div class="media-body">
                        <div class="lgi-heading">{{Auth::user()->name}}</div>
                        <small class="lg-hide-items">{{$doc->comment}}</small>
                    </div>
                </div>
            @endif
            <ul class="lgi-attrs f-500">
                <li class="f-500">Date Uploaded: {{$doc->updated_at->toDayDateTimeString()}}</li>
                @if($doc->status==1)
                    <li class="lgi-approved f-500">Approved: Yes</li>
                @elseif($doc->status==0)
                    <li class="lgi-approved">Approved: Pending</li>
                @endif
                @if($doc->completion==3)
                    <li class="lgi-completion">Completion: Not Completed</li>
                @elseif($doc->completion==2)
                    <li class="lgi-completion">Completion: Not to Standards</li>
                @elseif($doc->completion==1)
                    <li class="lgi-completion">Completion:Fully Completed</li>
                @endif
            </ul>
        </div>
    </div>
@endif