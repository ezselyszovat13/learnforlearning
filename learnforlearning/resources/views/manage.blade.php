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
                    <div class="container" style="padding-left: 0px;">
                        <div class="row">
                            @foreach ($activity_subjects as $element)
                                <div class="mb-2 col-md-12" style="padding-left: 0px;">
                                    <div class="card h-100">
                                        <p class="card-header">
                                            <span style="font-size: 1.3rem;font-weight:bold"> {{$element['teacher']->name}} </span>
                                            aktivitása kétséges
                                        </p>
                                        <div class="card-body">
                                            <p class="card-subtitle mb-2 text-muted">Az érintett kurzus: 
                                                <span class="font-weight-bold">{{$element['subjectName']}}</span>
                                            </p>
                                            <p class="card-subtitle mb-2 text-muted">Jelenlegi aktivitása: 
                                                <span class="font-weight-bold">{{$element['isActive'] ? "AKTÍV" : "NEM AKTÍV"}}</span>
                                            </p>
                                            <p class="card-subtitle mb-2 text-muted">Ennyien mondanak mást: 
                                                <span class="font-weight-bold">{{$element['goingAgainst']}}</span> felhasználó
                                            </p>
                                            <a class="btn btn-secondary btn-lg" style="font-size:0.8rem"
                                                href="{{ route('manage.changeActivity', ['subjectId' => $element['subjectId'],
                                                        'teacherId' => $element['teacher']->id, 'activity' => !$element['isActive']]) }}" 
                                                role="button"> Aktivitás megváltoztatása
                                            </a>
                                            <a class="btn btn-secondary btn-lg mt-2 mt-sm-0" style="font-size:0.8rem"
                                                href="{{ route('manage.resetAgainstActivity', ['subjectId' => $element['subjectId'], 
                                                        'teacherId' => $element['teacher']->id]) }}" 
                                                role="button"> Ajánlás elvetése
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                    <div class="container" style="padding-left: 0px;">
                        <div class="row">
                            @foreach ($pending_teachers as $element)
                                <div class="mb-2 col-md-6" style="padding-left: 0px;">
                                    <div class="card h-100">
                                        <p class="card-header">
                                            A javasolt oktató: 
                                            <span style="font-size: 1.3rem;font-weight:bold"> {{$element->name}} </span>
                                        </p>
                                        <div class="card-body">
                                            <a class="btn btn-secondary btn-lg mr-4 mt-2 mt-lg-0" style="font-size:0.8rem"
                                            href="{{ route('manage.addTeacher', ['teacherId' => $element->id]) }}" 
                                            role="button"> Oktató aktiválása
                                            </a>
                                            <a class="btn btn-secondary btn-lg mt-2 mt-lg-0" style="font-size:0.8rem"
                                                href="{{ route('manage.deleteTeacher', ['teacherId' => $element->id]) }}" 
                                                role="button"> Ajánlás elvetése
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                    <div class="container" style="padding-left: 0px;">
                        <div class="row">
                            @foreach ($pending_subjects as $subject)
                                <div class="mb-2 col-md-12" style="padding-left: 0px;">
                                    <div class="card h-100">
                                        <p class="card-header">
                                            Az ajánlott kurzus: 
                                            <span style="font-size: 1.3rem;font-weight:bold"> {{$subject->name}} </span>
                                            ({{$subject->code}})
                                        </p>
                                        <div class="card-body">
                                            <p class="card-subtitle mb-2 text-muted">Itt létezik:
                                                <span class="font-weight-bold">
                                                    {{ $subject->existsOnA ? 'A ' : ''}}
                                                    {{ $subject->existsOnB ? 'B ' : ''}}
                                                    {{ $subject->existsOnC ? 'C ' : ''}}
                                                </span>
                                            </p>
                                            <p class="card-subtitle mb-2 text-muted">Itt opcionális:
                                                <span class="font-weight-bold">
                                                    {{ $subject->optionalOnA ? 'A ' : ''}}
                                                    {{ $subject->optionalOnB ? 'B ' : ''}}
                                                    {{ $subject->optionalOnC ? 'C ' : ''}}
                                                </span>
                                            </p>
                                            <p class="card-subtitle mb-2 text-muted">Kreditértéke:
                                                <span class="font-weight-bold">
                                                    {{$subject->credit_points}}
                                                </span>
                                            </p>
                                            <p class="card-subtitle mb-2 text-muted">Páros féléves? 
                                                <span class="font-weight-bold">
                                                    {{$subject->even_semester ? '✔' :'❌'}}
                                                </span>
                                            </p>
                                            <a class="btn btn-secondary btn-lg mr-4" style="font-size:0.8rem"
                                               href="{{ route('manage.addSubject', ['subjectId' => $subject->id]) }}" 
                                               role="button"> Kurzus aktiválása
                                            </a>
                                            <a class="btn btn-secondary btn-lg mt-2 mt-sm-0" style="font-size:0.8rem"
                                               href="{{ route('manage.deleteSubject', ['subjectId' => $subject->id]) }}" 
                                               role="button"> Ajánlás elvetése
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
