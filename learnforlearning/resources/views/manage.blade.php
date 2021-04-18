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
            @if (session()->has('activity_change_declined'))
                @if (session()->get('activity_change_declined') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az aktivitás megváltoztatása sikeresen elutasítva!
                    </div>
                @endif
            @endif
            <h2>Egy, már meglévő oktató aktivitásának változása</h2>
            @if(isset($activity_subjects))
                @if(count($activity_subjects)!==0)
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kurzus neve</th>
                                <th scope="col">Oktató neve</th>
                                <th scope="col">Jelenlegi aktivitása</th>
                                <th scope="col">Ennyien mondanak mást</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($activity_subjects as $element)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$element['subjectName']}}</td>
                                <td>{{$element['teacher']->name}}</td>
                                <td>{{$element['isActive'] ? "AKTÍV" : "NEM AKTÍV"}}</td>
                                <td>{{$element['goingAgainst']}}</td>
                                <td>
                                    <a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank"
                                        href="{{ route('manage.changeActivity', ['subjectId' => $element['subjectId'],
                                                'teacherId' => $element['teacher']->id, 'activity' => !$element['isActive']]) }}" 
                                        role="button"> Aktivitás megváltoztatása
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank"
                                        href="{{ route('manage.resetAgainstActivity', ['subjectId' => $element['subjectId'], 
                                                 'teacherId' => $element['teacher']->id]) }}" 
                                        role="button"> Ajánlás elvetése
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
            @if (session()->has('teacher_not_exists_add'))
                @if (session()->get('teacher_not_exists_add') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        Az aktiválni kívánt oktató nem létezik!
                    </div>
                @endif
            @endif
            @if (session()->has('teacher_accepted'))
                @if (session()->get('teacher_accepted') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az oktató aktiválásra került!
                    </div>
                @endif
            @endif
            @if (session()->has('teacher_deleted'))
                @if (session()->get('teacher_deleted') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az oktató törlésre került!
                    </div>
                @endif
            @endif
            @if (session()->has('teacher_not_exists_delete'))
                @if (session()->get('teacher_not_exists_delete') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az törölni kívánt oktató nem létezik!
                    </div>
                @endif
            @endif
            <h2>Új oktató ajánlása</h2>
            @if(isset($pending_teachers))
                @if(count($pending_teachers)!==0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Oktató neve</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pending_teachers as $element)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$element->name}}</td>
                                <td>
                                    <a class="btn btn-primary btn-lg mr-4" style="font-size:0.8rem" target="_blank"
                                        href="{{ route('manage.addTeacher', ['teacherId' => $element->id]) }}" 
                                        role="button"> Oktató aktiválása
                                    </a>
                                    <a class="btn btn-primary btn-lg mt-2 mt-sm-0" style="font-size:0.8rem" target="_blank"
                                        href="{{ route('manage.deleteTeacher', ['teacherId' => $element->id]) }}" 
                                        role="button"> Ajánlás elvetése
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
            @if (session()->has('subject_not_exists_add'))
                @if (session()->get('subject_not_exists_add') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        Az aktiválni kívánt kurzus nem létezik!
                    </div>
                @endif
            @endif
            @if (session()->has('subject_accepted'))
                @if (session()->get('subject_accepted') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A kurzus aktiválásra került!
                    </div>
                @endif
            @endif
            @if (session()->has('subject_not_exists_delete'))
                @if (session()->get('subject_not_exists_delete') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az törölni kívánt kurzus nem létezik!
                    </div>
                @endif
            @endif
            @if (session()->has('subject_deleted'))
                @if (session()->get('subject_deleted') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A kurzus törlésre került!
                    </div>
                @endif
            @endif
            <h2>Új kurzus ajánlása</h2>
            @if(isset($pending_subjects))
                @if(count($pending_subjects)!==0)
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kurzus neve</th>
                                <th scope="col">Kurzus kódja</th>
                                <th scope="col">Szakirányok</th>
                                <th scope="col">Itt opcionális</th>
                                <th scope="col">Kreditérték</th>
                                <th scope="col">Páros féléves tárgy</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pending_subjects as $subject)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->code}}</td>
                                <td>
                                    {{ $subject->existsOnA ? 'A ' : ''}}
                                    {{ $subject->existsOnB ? 'B ' : ''}}
                                    {{ $subject->existsOnC ? 'C ' : ''}}
                                </td>
                                <td>
                                    {{ $subject->optionalOnA ? 'A ' : ''}}
                                    {{ $subject->optionalOnB ? 'B ' : ''}}
                                    {{ $subject->optionalOnC ? 'C ' : ''}}
                                </td>
                                <td>{{$subject->credit_points}}</td>
                                <td>{{$subject->even_semester ? "IGEN" : "NEM"}}</td>
                                <td>
                                    <a class="btn btn-primary btn-lg mr-4" style="font-size:0.8rem" target="_blank"
                                        href="{{ route('manage.addSubject', ['subjectId' => $subject->id]) }}" 
                                        role="button"> Kurzus aktiválása
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank"
                                        href="{{ route('manage.deleteSubject', ['subjectId' => $subject->id]) }}" 
                                        role="button"> Ajánlás elvetése
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
        </div>
    </div>
@endsection
