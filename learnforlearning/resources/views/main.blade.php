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
        </div>
    </div>
@endsection
