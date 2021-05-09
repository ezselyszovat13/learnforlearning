@extends('layouts.app')

@section('title', 'Egy adott tárgy listázása')

@section('content')
    <div class="container">
        <div class="jumbotron">
            @if (session()->has('comment_added'))
                @if (session()->get('comment_added') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A megjegyzés sikeresen elküldve!
                    </div>
                @endif
            @endif
            @if (session()->has('teacher_not_existed'))
                @if (session()->get('teacher_not_existed') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        A kommentolvasáshoz használt oktató nem létezik!
                    </div>
                @endif
            @endif
            @if (session()->has('comment_deleted'))
                @if (session()->get('comment_deleted') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A megjegyzés sikeresen eltávolítva!
                    </div>
                @else
                    <div class="alert alert-danger mb-3" role="alert">
                        A megjegyzés eltávolítása sikertelen volt!
                    </div>
                @endif
            @endif
            <div>
                <h1>
                    <span class="font-weight-bold">{{$subject->name}}</span>
                    <span class="ml-2" style="font-size: 1.8rem">({{$subject->code}})</span>
                    <a class="btn btn-secondary btn-lg" target="__blank" href="{{ $subject->url }}" role="button">További információk</a>
                    @if(isset($page))
                        @if($page === 'calculation')
                            <a class="btn btn-secondary btn-lg" href="{{ route('findsubject') }}" role="button">Vissza a kalkulációhoz</a>
                        @elseif($page === 'grades')
                            <a class="btn btn-secondary btn-lg" href="{{ route('newsubject') }}" 
                               role="button">Vissza az érdemjegyekhez</a>
                        @elseif($page === 'subjects')
                            <a class="btn btn-secondary btn-lg" href="{{ route('subjects') }}" role="button">Vissza a kurzusokhoz</a>
                        @endif
                    @endif
                </h1>
            </div>
            
            <hr class="my-4">
            <div>
                @if($subject->even_semester)
                    <p style="font-size: 1.2rem;">Ez általában egy 
                        <span style="font-size: 1.5rem;font-weight:bold">páros</span> féléves tárgy.
                    </p>
                @else
                <p style="font-size: 1.2rem;">Ez általában egy 
                    <span style="font-size: 1.5rem;font-weight:bold">páratlan</span> féléves tárgy.
                </p>
                @endif
            </div>
            <div>
                <p style="font-size: 1.2rem;">Kreditérték: 
                    <span style="font-size: 1.5rem;font-weight:bold">{{$subject->credit_points}}</span>
                </p>
            </div>
            <div>
                <p style="font-size: 1.2rem;">Ezeken a szakirányokon érhető el: 
                    <span style="font-size: 1.5rem;font-weight:bold">@if($subject->existsOnA) A @endif</span>
                    <span style="font-size: 1.5rem;font-weight:bold">@if($subject->existsOnB) B @endif</span>
                    <span style="font-size: 1.5rem;font-weight:bold">@if($subject->existsOnC) C @endif</span>
                </p>
            </div>
            @if(isset($teachers))
                @if(count($teachers)!=0)
                    <div class="container">
                        <div class="row">
                            <h1 class="mx-auto">Oktatók</h1>
                        </div>
                    </div>
                    <div class="container" style="padding-left: 0px;">
                        <div class="row">
                            @foreach ($teachers as $teacher) 
                                @if($teacher->pivot->is_active) 
                                <div class="mb-2 col-md-4" style="padding-left: 0px;">
                                    <div class="card h-40">
                                        <p id="{{'c'.$teacher->id}}" class="card-header h-100 {{$votes[$teacher->id]['points']>0 ? 'bg-success' : ''}} 
                                                  {{ $votes[$teacher->id]['points']<0 ? 'bg-danger' : ''}}">
                                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $teacher->name }} </span> 
                                            <a class="btn" data-toggle="tooltip" title="A megjegyzésekért kattints ide!"
                                               href="{{ route('teacher.comments', ['id' => $teacher->id, 'page' => isset($page) ? 
                                                     $page : null, 'subpage' => 'subject', 'subjectId' => $subject->id]) }}" 
                                               role="button">❓
                                            </a>
                                        </p>
                                        <div class="card-body h-60">
                                            <p> Kedveltség:
                                                <span id="{{'s'.$teacher->id}}">
                                                    @if($votes[$teacher->id]['points']>0)
                                                        <span style="font-weight:bold;color:green">+{{$votes[$teacher->id]['points']}}</span>
                                                    @elseif($votes[$teacher->id]['points']==0)
                                                        <span style="font-weight:bold">{{$votes[$teacher->id]['points']}}</span>
                                                    @else
                                                        <span style="font-weight:bold;color:red">{{$votes[$teacher->id]['points']}}</span>
                                                    @endif
                                                </span>
                                            </p>
                                            <p>
                                                @if(isset($user)) 
                                                    <span id="{{'l'.$teacher->id}}" style="width:20px;{{ $votes[$teacher->id]['hasPosVote'] ? 'opacity:1' : 
                                                             'opacity:0.5' }}">
                                                        <span data-id="{{$teacher->id}}" class="btn btn-lg voter pos" >👍</span>
                                                    </span>
                                                    <span id="{{'d'.$teacher->id}}" style="width:20px;{{ $votes[$teacher->id]['hasNegVote'] ? 'opacity:1' : 
                                                                'opacity:0.5' }}">
                                                        <span data-id="{{$teacher->id}}" class="btn btn-lg voter neg">💔</span>
                                                    </span>
                                                    <span style="width:20px;">
                                                        <a class="btn btn-lg" href="{{ route('user.comment', ['teacherId' => $teacher->id,
                                                                'subjectId' => $subject->id, 'page' => isset($page) ? $page : null]) }}" 
                                                           role="button">💬
                                                        </a>
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger mt-3" role="alert">
                        <p>Nincsenek megjeleníthető oktatók!</p>
                    </div>
                @endif
            @else
                <div class="alert alert-danger mt-3" role="alert">
                    <p>Nincsenek megjeleníthető oktatók!</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.voter').click(function () { 
                teacher_id = $(this).data("id");
                is_pos = $(this).hasClass("pos") ? 1 : 0;
                had_pos_vote = $('#l'+teacher_id).css('opacity') == 1;
                had_neg_vote = $('#d'+teacher_id).css('opacity') == 1;
                $.ajaxSetup({
                    beforeSend: function(xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
               });
               $.ajax({
                  url: "{{ url('/subject/vote/') }}",
                  type: 'GET',
                  data: {
                     teacherId: teacher_id,
                     isPositive: is_pos
                  },
                  success: function(result){
                     like_num = parseInt($("#s"+teacher_id).text());
                     if(result.state === "1"){
                         $("#l"+teacher_id).css('opacity',1);
                         $("#d"+teacher_id).css('opacity',0.5);
                         if(had_neg_vote){
                            like_num += 2;
                         }
                         else{
                            like_num += 1;
                         }
                     }
                     else if(result.state === "0"){
                         $("#l"+teacher_id).css('opacity',0.5);
                         $("#d"+teacher_id).css('opacity',1);
                         if(had_pos_vote){
                            like_num -= 2;
                         }
                         else{
                            like_num -= 1;
                         }
                     }
                     else{
                         $("#l"+teacher_id).css('opacity',0.5);
                         $("#d"+teacher_id).css('opacity',0.5);
                         if(had_neg_vote){
                            like_num += 1;
                         }
                         else if(had_pos_vote){
                            like_num -= 1;
                         }
                     }
                     if(like_num>0){
                        result = '<span style="font-weight:bold;color:green">+'+like_num+'</span>';
                        $("#c"+teacher_id).removeClass('bg-danger');
                        $("#c"+teacher_id).addClass('bg-success');
                     }
                     else if(like_num<0){
                        result = '<span style="font-weight:bold;color:red">'+like_num+'</span>';
                        $("#c"+teacher_id).removeClass('bg-success');
                        $("#c"+teacher_id).addClass('bg-danger');
                     }
                     else{
                        result = '<span style="font-weight:bold">'+like_num+'</span>';
                        $("#c"+teacher_id).removeClass('bg-danger');
                        $("#c"+teacher_id).removeClass('bg-success');
                     }
                     $("#s"+teacher_id).html(result);
                  },
                  error: function (data, textStatus, errorThrown) {
                     console.log(data);
                  }
                });
            });
        });
    </script>
@endsection
