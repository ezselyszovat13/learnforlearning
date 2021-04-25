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
            <h1 class="display-4">{{$subject->name}}<span class="ml-2" style="font-size: 1.8rem">({{$subject->code}})</span>
                <a class="btn btn-primary btn-lg" target="__blank" href="{{ $subject->url }}" role="button">További információk</a>
            </h1>
            
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
                    <div class="container">
                        <div class="row">
                            @foreach ($teachers as $teacher) 
                                @if($teacher->pivot->is_active) 
                                <div class="mb-2 col-md-4">
                                    <div class="card h-40">
                                        <p class="card-header h-100 {{$votes[$teacher->id]['points']>0 ? 'bg-success' : ''}} 
                                                  {{ $votes[$teacher->id]['points']<0 ? 'bg-danger' : ''}}">
                                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $teacher->name }} </span> 
                                            <a class="btn" data-toggle="tooltip" title="A megjegyzésekért kattints ide!"
                                               href="{{ route('teacher.comments', ['id' => $teacher->id]) }}" role="button">❓
                                            </a>
                                        </p>
                                        <div class="card-body h-60">
                                            <p> Kedveltség: 
                                                @if($votes[$teacher->id]['points']>0)
                                                    <span style="font-weight:bold;color:green">+{{$votes[$teacher->id]['points']}}</span>
                                                @elseif($votes[$teacher->id]['points']==0)
                                                    <span style="font-weight:bold">{{$votes[$teacher->id]['points']}}</span>
                                                @else
                                                    <span style="font-weight:bold;color:red">{{$votes[$teacher->id]['points']}}</span>
                                                @endif
                                            </p>
                                            <p>
                                                @if(isset($user)) 
                                                    <span style="width:20px;{{ $votes[$teacher->id]['hasPosVote'] ? 'opacity:1' : 'opacity:0.5' }}">
                                                        <a class="btn btn-lg" href="{{ route('user.vote', ['teacherId' => $teacher->id, 
                                                                'isPositive' => true, 'subjectId' => $subject->id]) }}" 
                                                        role="button">👍
                                                        </a>
                                                    </span>
                                                    <span style="width:20px;{{ $votes[$teacher->id]['hasNegVote'] ? 'opacity:1' : 'opacity:0.5' }}">
                                                        <a class="btn btn-lg" href="{{ route('user.vote', ['teacherId' => $teacher->id, 
                                                                'isPositive' => false, 'subjectId' => $subject->id]) }}" 
                                                        role="button">💔
                                                        </a>
                                                    </span>
                                                    <span style="width:20px;">
                                                        <a class="btn btn-lg" href="{{ route('user.comment', ['teacherId' => $teacher->id,
                                                                'subjectId' => $subject->id]) }}" role="button">💬
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
@endsection
