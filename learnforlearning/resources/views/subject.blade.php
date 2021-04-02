@extends('layouts.app')

@section('title', 'Információ')

@section('content')
    <div class="container">
        <div class="jumbotron">
            @if (session()->has('comment_added'))
                @if (session()->get('comment_added') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A hozzászólás sikeresen elküldve.
                    </div>
                @endif
            @endif
            <h1 class="display-4">{{$subject->name}}<span class="ml-2" style="font-size: 1.8rem">({{$subject->code}})</span>
                <a class="btn btn-primary btn-lg" target="__blank" href="{{ $subject->url }}" role="button">További információk</a>
            </h1>
            
            <hr class="my-4">
            <div>
                @if($subject->even_semester)
                    <p style="font-size: 1.2rem;">Ez általában egy <span style="font-size: 1.5rem;font-weight:bold">páros</span> féléves tárgy.</p>
                @else
                <p style="font-size: 1.2rem;">Ez általában egy <span style="font-size: 1.5rem;font-weight:bold">páratlan</span> féléves tárgy.</p>
                @endif
            </div>
            <div>
                <p style="font-size: 1.2rem;">Kreditérték: <span style="font-size: 1.5rem;font-weight:bold">{{$subject->credit_points}}</span></p>
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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Oktató neve</th>
                                <th scope="col">Kedveltség</th>
                                @if(isset($user)) 
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($teachers as $teacher)       
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$teacher->name}}</td>
                                @if($votes[$teacher->id]['points']>0)
                                    <td style="font-weight:bold;color:green">+{{$votes[$teacher->id]['points']}}</td>
                                @elseif($votes[$teacher->id]['points']==0)
                                    <td style="font-weight:bold">{{$votes[$teacher->id]['points']}}</td>
                                @else
                                    <td style="font-weight:bold;color:red">{{$votes[$teacher->id]['points']}}</td>
                                @endif
                                @if(isset($user)) 
                                    <td style="width:20px;{{ $votes[$teacher->id]['hasPosVote'] ? 'opacity:1' : 'opacity:0.5' }}"><a class="btn btn-lg" href="{{ route('user.vote', ['teacherId' => $teacher->id, 'isPositive' => true, 'subjectId' => $subject->id]) }}" role="button">👍</a></td>
                                    <td style="width:20px;{{ $votes[$teacher->id]['hasNegVote'] ? 'opacity:1' : 'opacity:0.5' }}"><a class="btn btn-lg" href="{{ route('user.vote', ['teacherId' => $teacher->id, 'isPositive' => false, 'subjectId' => $subject->id]) }}" role="button">💔</a></td>
                                    <td style="width:20px;"><a class="btn btn-lg" href="{{ route('user.comment', ['teacherId' => $teacher->id, 'subjectId' => $subject->id]) }}" role="button">💬</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
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
