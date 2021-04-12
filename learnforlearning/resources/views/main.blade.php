@extends('layouts.app')

@section('title', 'Kezdőlap')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Üdvözöllek!</h1>
            <p class="lead">Jelen szoftverünk célja a kötelezően választható tárgyak közül meghatározni, hogy egyénenként kinek mely tárgy lenne a legalkalmasabb a felvételre.</p>
            <hr class="my-4">
            <ul>
                <li>Az alkalmazást használó felhasználók száma: {{ $users }}</li>
                <li>A felhasznált adatok mennyisége: {{ $data }}</li>
            </ul>
            <a class="btn btn-primary btn-lg" href="{{route('subjects')}}" role="button">Tárgyak listázása</a>
            @if(count($comments) != 0) 
                <hr class="my-4">
                <h2>Néhány, a felhasználók által alkotott megjegyzés</h2> 
            @endif
            @foreach ($comments as $comment)
                <div class="mb-2">
                    <div class="card">
                        <p class="card-header">
                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $comment['author'] }} </span> írta 
                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $comment['teacher'] }} </span> személyről 
                        </p>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $comment['comment'] }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
            <hr class="my-4">
            <p>
                A felhasználók szerinti jelenlegi legjobb oktató: <span style="font-size: 1.3rem;font-weight:bold"> {{ $bestTeacher }} </span> 
            </p>
        </div>
    </div>
@endsection
