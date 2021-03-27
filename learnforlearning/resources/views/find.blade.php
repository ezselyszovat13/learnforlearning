@extends('layouts.app')

@section('title', 'Adatok')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Kötelezően választható tárgy keresése</h1>
            <hr class="my-4">
            <div class="container">
                <div class="row">
                    <h2 class="mx-auto">A számodra még elérhető kötelezően választható tárgyak</h2>
                </div>
            </div>
            <div>
                @foreach ($optionalSubjects as $subject)
                    <span class="badge badge-primary">
                        <a target="__blank" style="color: white !important;font-size:14px" href="{{ $subject->url }}">{{ $subject->name }}</a>
                    </span>
                @endforeach
            </div>
            <hr class="my-4">
            <div class="container">
                <div class="row">
                    <h2 class="mx-auto">A korábban kalkulált kurzusok a számodra</h2>
                </div>
            </div>
            <hr class="my-4">
            <p class="lead">A "Kalkulál" gombra kattintva megtudhatod, hogy melyik lenne számodra a legkedvezőbb kötelezően választható tárgy a következő félévre.</p>
            <div class="container">
                <div class="row">
                    <a class="btn btn-primary btn-lg {{ $canCalculate ? '' : 'disabled' }} mx-auto" href="{{route('calculate')}}" role="button">Kalkulál</a>
                </div>
            </div>
            @if (session()->has('calculated_subject_name'))
                <div class="alert alert-success mt-3" role="alert">
                    A következő tárgy javasolandó: {{ session()->get('calculated_subject_name') }}
                </div>
            @endif
            @if (session()->has('calculate_failed'))
                @if (session()->get('calculate_failed') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        Számodra nincs megfelelő kötelezően választható tárgy!
                    </div>
                @endif
            @endif
            @if(!$canCalculate)
                <p style="color:red" class="mt-3">Kérlek válassz szakirányt, hogy kalkulálni tudjunk a számodra!</p>
            @endif
        </div>
    </div>
@endsection
