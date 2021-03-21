@extends('layouts.app')

@section('title', 'Adatok')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Kötelezően választható tárgy keresése</h1>
            <p class="lead">A "Kalkulál" gombra kattintva megtudhatod, hogy melyik lenne számodra a legkedvezőbb kötelezően választható tárgy a következő félévre.</p>
            <hr class="my-4">
            <a class="btn btn-primary btn-lg {{ $canCalculate ? '' : 'disabled' }}" href="" role="button">Kalkulál</a>
            @if(!$canCalculate)
                <p style="color:red" class="mt-3">Kérlek válassz szakirányt, hogy kalkulálni tudjunk a számodra!</p>
            @endif
        </div>
    </div>
@endsection
