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
            <div>
                @if(count($calculationHistory)!==0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kurzus neve</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calculationHistory as $element)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $subData[$element->subject_code]['name'] }}</td>
                                    <td><a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank" href="{{ $subData[$element->subject_code]['url'] }}" role="button">Információk</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row">
                            <a class="btn btn-primary btn-lg ml-auto" href="{{route('findsubject.delete')}}" role="button">Eddigi kalkulációk törlése</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger mb-3" role="alert">
                        Még nem használtad a kalkulációs funkciót!
                    </div>
                @endif
            </div>
            <hr class="my-4">
            <p class="lead">A "Kalkulál" gombra kattintva megtudhatod, hogy melyik lenne számodra a legkedvezőbb kötelezően választható tárgy a következő félévre.</p>
            <form action="{{route('calculate')}}" method="POST">
                    @csrf
                <div class="form-group">
                    <div class="container">
                        <div class="row">
                            <label for="semester" class="mr-4 mt-2">Aktuális félév: </label>
                            <select id="semester" name="semester" class="mr-4 col-md-4 form-control {{ $errors->has('semester') ? 'is-invalid' : '' }}" autofocus>
                                <option value="1">Ősszel induló félév</option>
                                <option value="2">Tavasszal induló félév</option>
                            </select>
                            <button type="submit" class="btn btn-primary {{ $canCalculate ? '' : 'disabled' }} mr-auto">Kalkulál</button>
                        </div>
                    </div>
            </form>
            @if (session()->has('calculated_subject'))
                <div class="alert alert-success mt-3" role="alert">
                    A következő tárgy javasolandó: {{ session()->get('calculated_subject')->name }}
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
            @if (session()->has('calculations_deleted'))
                @if (session()->get('calculations_deleted') == true)
                    <div class="alert alert-danger mt-3" role="alert">
                        A korábbi kalkulációk törlésre kerültek!
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
