@extends('layouts.app')

@section('title', 'Tárgyak listázása')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Kurzusok</h1>
            <p class="lead">Itt láthatod, hogy milyen tárgyakat végezhetsz egyetemi tanulmányaid során, 
                melyek nem a szabadon választható kategóriába tartoznak!
            </p>
            @if (session()->has('subject_not_found'))
                @if (session()->get('subject_not_found') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        Az értékelni kívánt tárgy nem létezik.
                    </div>
                @endif
            @endif
            @if (session()->has('subject_not_found_watch'))
                @if (session()->get('subject_not_found_watch') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        A megtekinteni kívánt tárgy nem létezik.
                    </div>
                @endif
            @endif
            @if (session()->has('teacher_not_found'))
                @if (session()->get('teacher_not_found') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        Az értékelni kívánt oktató nem létezik.
                    </div>
                @endif
            @endif
            @if(isset($subjects))
                @if(count($subjects)!=0)
                    <div class="container">
                        <div class="row">
                            @foreach ($subjects as $subject)
                                <div class="mb-2 col-md-4">
                                    <div class="card h-100">
                                        <p class="card-header">
                                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $subject->name }} </span> {{ $subject->code}}
                                        </p>
                                        <div class="card-body">
                                            @if($subject->even_semester)
                                                <p class="card-subtitle mb-2 text-muted">A tárgy féléve: PÁROS</p>
                                            @else
                                                <p class="card-subtitle mb-2 text-muted">A tárgy féléve: PÁRATLAN</p>
                                            @endif
                                            <a class="btn btn-primary btn-lg" href="{{ route('subjects.info', ['id' => $subject->id]) }}"
                                                role="button">Információk</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger mt-3" role="alert">
                        <p>Nincsenek megjeleníthető kurzusok!</p>
                    </div>
                @endif
            @else
                <div class="alert alert-danger mt-3" role="alert">
                    <p>Nincsenek megjeleníthető kurzusok!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
