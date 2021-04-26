@extends('layouts.app')

@section('title', 'Adatok')

@section('content')
    <div class="container">
        <div class="jumbotron">
            @if (session()->has('spec_updated'))
                @if (session()->get('spec_updated') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A specializáció módosítása sikeresen megtörtént!
                    </div>
                @endif
            @endif

            <h1 class="display-4">Adatok</h1>
            <p class="lead">Itt láthatóak a megadott személyes adataid, valamint egyéb kalkulált eredményeid!</p>
            <hr class="my-4">
            <div>
                <p style="font-size: 1.2rem;">Megadott név: 
                    <span style="font-size: 1.5rem;font-weight:bold">{{$user->name}}</span>
                </p>
            </div>
            <div>
                <p style="font-size: 1.2rem;">
                @if($user->spec !== 'NOTHING')
                    Szakirány: <span style="font-size: 1.5rem;font-weight:bold">{{$user->spec}}</span>
                @else
                    <span style="font-size: 1.5rem;font-weight:bold"> Még nem választottál szakirányt </span>
                @endif</p>
            </div>
            <div>
                @if($user->getGradesCount() !== 0)
                    <p style="font-size: 1.2rem;">
                        Jelenleg <span style="font-size: 1.5rem;font-weight:bold"> {{ $user->getGradesCount()}} </span> 
                        darab eredményt vettél fel az alkalmazásban, melyek átlaga: 
                        <span style="font-size: 1.5rem;font-weight:bold"> 
                            {{ $user->getGradesCount() != 0 ? round($user->getGradesAverage(),2) : '-'}} 
                        </span>
                    </p>
                    
                    <p style="font-size: 1.2rem;">
                        Ebből <span style="font-size: 1.5rem;font-weight:bold"> {{ $user->getOptionalGradesCount()}} </span> 
                        darab tárgy volt kötelezően választható, melyek átlaga: 
                        <span style="font-size: 1.5rem;font-weight:bold"> 
                            {{ $user->getOptionalGradesCount() != 0 ? round($user->getOptionalGradesAverage(),2) : '-'}} 
                        </span>
                    </p>

                    <p style="font-size: 1.2rem;">Eddig <span style="font-size: 1.5rem;font-weight:bold"> 
                    {{$user->getAcquiredCredits()}} </span> kreditet szereztél.</p>
                @else
                    <p style="font-size: 1.5rem;font-weight:bold">Jelenleg még nincs rögzített érdemjegyed!</p>
                @endif
            </div>
            <a class="btn btn-secondary btn-lg" href="{{ route('spec.edit', ['id' => $user->id]) }}" 
               role="button">Szakirány módosítása
            </a>
    
            <hr class="my-4">
            @if (session()->has('comment_updated'))
                @if (session()->get('comment_updated') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A megjegyzés sikeresen megváltoztatva!
                    </div>
                @endif
            @endif
            <h2>Az oktatókról írt megjegyzéseid</h2>
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
            @forelse ($comments as $key => $data)
                @if($data['comment'] !== null)
                <div class="mb-2">
                    <div class="card">
                        <p class="card-header {{$data['is_positive_vote'] ? 'bg-success' : ''}} 
                                  {{(!$data['is_positive_vote'] && $data['is_positive_vote'] !== null) ? 'bg-danger' : ''}}">
                            Véleményezett oktató: 
                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $data['teacher_name'] }} </span>
                            <a class="btn btn-secondary ml-3" style="font-size:0.6rem"
                                href="{{ route('personal.delete.comment', ['teacherId' => $key]) }}" 
                                role="button"> Megjegyzés törlése
                            </a>
                        </p>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $data['comment'] }}</h6>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div role='alert' class="alert alert-danger">
                    <p>Még nem írtál megjegyzéseket!</p>
                </div>
            @endforelse
            @if(!$was_comment && count($comments)>0)
                <div role='alert' class="alert alert-danger">
                    <p>Még nem írtál megjegyzéseket!</p>
                </div>
            @endif

            <hr class="my-4">
            @if (session()->has('vote_updated'))
                @if (session()->get('vote_updated') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A szavazat sikeresen megváltoztatva!
                    </div>
                @endif
            @endif
            <h2>Az oktatókra leadott szavazataid</h2>
            @if($was_like)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Oktató neve</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
            @endif
            @forelse ($comments as $key => $data)
                @if($data['is_positive_vote'] !== null)
                    <tr>
                        <td style="width:300px;"> {{$data['teacher_name']}} </td>
                        <td style="width:20px;{{ $data['is_positive_vote'] ? 'opacity:1' : 'opacity:0.5' }}">
                            <a class="btn btn-lg" 
                               href="{{ route('personal.vote', ['teacherId' => $key, 'isPositive' => true]) }}" role="button">👍
                            </a>
                        </td>
                        <td style="width:20px;{{ !$data['is_positive_vote'] ? 'opacity:1' : 'opacity:0.5' }}">
                            <a class="btn btn-lg" 
                               href="{{ route('personal.vote', ['teacherId' => $key, 'isPositive' => false]) }}" role="button">💔
                            </a>
                        </td>
                    </tr>
                @endif
            @empty
                <div role='alert' class="alert alert-danger">
                    <p>Még nem szavaztál oktatóra!</p>
                </div>
            @endforelse
            @if($was_like)
                </tbody>
            </table>
            @endif
            @if(!$was_like && count($comments)>0)
                <div role='alert' class="alert alert-danger">
                    <p>Még nem szavaztál oktatóra!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
