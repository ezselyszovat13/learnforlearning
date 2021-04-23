@extends('layouts.app')

@section('title', 'Új érdemjegyek felvétele')

@section('content')
    <div class="container">
        <div class="jumbotron">
            @if (session()->has('grade_added'))
                @if (session()->get('grade_added') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az új érdemjegy sikeresen felvéve!
                    </div>
                @else
                    <div class="alert alert-danger mb-3" role="alert">
                        Ehhez a kurzushoz már tartozik érdemjegy!
                    </div>
                @endif
            @endif

            @if (session()->has('subject_not_exists'))
                @if (session()->get('subject_not_exists') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        A szerkeszteni kívánt kurzus nem létezik!
                    </div>
                @endif
            @endif

            @if (session()->has('grade_updated'))
                @if (session()->get('grade_updated') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        Az érdemjegy módosítása sikeresen megtörtént!
                    </div>
                @endif
            @endif

            <h1 class="display-4">Új érdemjegyek felvétele</h1>
            <p class="lead">Itt tölthetsz fel új érdemjegyeket a hatékonyabb adatmeghatározáshoz!</p>
            <hr class="my-4">
            <h2>Eddig felvett eredmények: </h2>
            @if(isset($user_subjects))
                @if(count($user_subjects)!=0)
                    <div class="container">
                        <div class="row">
                            @foreach ($user_subjects as $subject)
                                <div class="mb-2 col-md-6">
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
                                            <p class="card-subtitle mb-2 text-muted"> Elért érdemejgy: 
                                                <span style="font-size: 1.3rem;font-weight:bold">{{$subject->pivot->grade}}</span>
                                            </p>
                                            <a class="btn btn-primary btn-lg mb-2 mb-sm-0" style="font-size:0.8rem" target="_blank" 
                                                    href="{{ route('subjects.info', ['id' => $subject->id]) }}" role="button">Információk
                                            </a>
                                            <a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank" 
                                                    href="{{ route('newsubject.edit', ['id' => $subject->id]) }}" 
                                                    role="button">Jegy szerkesztése
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div role='alert' class="alert alert-danger">
                        <p>Még nem történt jegybevitel!</p>
                    </div>
                @endif
            @else
                <div role='alert' class="alert alert-danger">
                    <p>Még nem történt jegybevitel!</p>
                </div>
            @endif

            <hr class="my-4">
            @if(isset($subjects))
                @if(count($subjects)!=0)
                <form action="{{route('subject.add')}}" method="POST">
                    @csrf
                    <div class="form-group form-inline">
                        <label for="subject" class="text-md-right mr-4">Kurzus: </label>
                        <select id="subject" name="subject" class="form-control 
                            {{ $errors->has('subject') ? 'is-invalid' : '' }}" autofocus>
                            <option value="">Válassz opciót!</option>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject['id']}}" {{ (old('subject') == $subject["id"] ? 'selected':'') }}>
                                    {{$subject["name"]}}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('subject'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-inline">
                        <label for="subject" class="text-md-right mr-4">Érdemjegy: </label>
                        <input type="text" class="mr-4 form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" 
                               id="grade" name="grade" value="{{ old('grade') ? old('grade') : ''}}">
                        @if ($errors->has('grade'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('grade') }}</strong>
                            </div>
                        @endif

                        <div class="my-3">
                        <button type="submit" class="btn btn-primary">Adatbevitel</button>
                        </div>
                    </div>
                </form>
                @else
                    <div role='alert' class="alert alert-danger">
                        <p>Nincsenek megjeleníthető kurzusok!</p>
                    </div>
                @endif
            @else
                <div role='alert' class="alert alert-danger">
                    <p>Nincsenek megjeleníthető kurzusok!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
