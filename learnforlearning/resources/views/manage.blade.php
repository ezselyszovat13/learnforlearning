@extends('layouts.app')

@section('title', 'Javaslatok kezelése')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Javaslatok kezelése</h1>
            <p class="lead">Itt láthatóak a felhasználók által beérkezett javítási ötletek az alkalmazásról!</p>
            <hr class="my-4">
            @if (session()->has('activity_changed'))
                @if (session()->get('activity_changed') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az aktivitás sikeresen megváltoztatva!
                    </div>
                @else
                    <div class="alert alert-danger mb-3" role="alert">
                        Az aktivitás megváltoztatása nem sikerült!
                    </div>
                @endif
            @endif
            @if (session()->has('teacher_not_exists'))
                @if (session()->get('teacher_not_exists') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        A megváltoztatni kívánt oktató nem létezik!
                    </div>
                @endif
            @endif
            @if (session()->has('subject_not_exists'))
                @if (session()->get('subject_not_exists') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        A megváltoztatni kívánt kurzus nem létezik!
                    </div>
                @endif
            @endif
            <h2>Egy, már meglévő oktató aktivitásának változása</h2>
            @if(isset($activitySubjects))
                @if(count($activitySubjects)!==0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kurzus neve</th>
                                <th scope="col">Oktató neve</th>
                                <th scope="col">Jelenlegi aktivitása</th>
                                <th scope="col">Ennyien mondanak mást</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($activitySubjects as $element)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$element['subjectName']}}</td>
                                <td>{{$element['teacher']->name}}</td>
                                <td>{{$element['isActive'] ? "AKTÍV" : "NEM AKTÍV"}}</td>
                                <td>{{$element['goingAgainst']}}</td>
                                <td>
                                    <a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank"
                                        href="{{ route('manage.changeActivity', ['subjectId' => $element['subjectId'], 'teacherId' => $element['teacher']->id, 'activity' => !$element['isActive']]) }}" 
                                        role="button"> Aktivitás megváltoztatása
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                     </table>
                @else
                    <div class="alert alert-danger mt-3" role="alert">
                        <p>Jelenleg nincsenek kérelmek!</p>
                    </div>
                @endif
            @else
                <div class="alert alert-danger mt-3" role="alert">
                    <p>Jelenleg nincsenek kérelmek!</p>
                </div>
            @endif
            <hr class="my-4">
            <h2>Új oktató ajánlása</h2>
            <hr class="my-4">
            <h2>Új kurzus ajánlása</h2>
        </div>
    </div>
@endsection
