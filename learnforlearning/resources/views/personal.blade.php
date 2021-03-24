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
            <p class="lead">Itt láthatóak a megadott személyes adataid</p>
            <hr class="my-4">
            <div>
                <p style="font-size: 1.2rem;">Megadott név: <span style="font-size: 1.5rem;font-weight:bold">{{$user->name}}</span></p>
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
                    <p style="font-size: 1.2rem;">Jelenleg <span style="font-size: 1.5rem;font-weight:bold"> {{ $user->getGradesCount()}} </span> darab jegyet 
                    vettél fel az alkalmazásban, 
                    melyek átlaga: <span style="font-size: 1.5rem;font-weight:bold"> {{ round($user->getGradesAverage(),2)}} </span></p>
                    <p style="font-size: 1.2rem;">Eddig <span style="font-size: 1.5rem;font-weight:bold"> 
                    {{$user->getAcquiredCredits()}} </span> kreditet szereztél.</p>
                @else
                    <p style="font-size: 1.5rem;font-weight:bold">Jelenleg még nincs rögzített érdemjegyed!</p>
                @endif
            </div>
            <a class="btn btn-primary btn-lg" href="{{ route('spec.edit', ['id' => $user->id]) }}" role="button">Szakirány módosítása</a>
        </div>
    </div>
@endsection
