@extends('layouts.app')

@section('title', 'Érdemjegy szerkesztése')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Érdemjegy szerkesztése</h1>
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
                                            @if($subject->id === $subject_to_update->id)
                                                <form action="{{ route('newsubject.update', ['id' => $subject->id]) }}" method="POST">
                                                    @csrf
                                                    <p class="card-subtitle mb-2 text-muted"> Elért érdemejgy: </p>
                                                    <input type="text" class="{{ $errors->has('grade') ? 'is-invalid' : '' }}" id="grade" 
                                                    name="grade" value="{{ old('grade') ? old('grade') : $grade}}">
                                                    
                                                    <a class="btn btn-primary btn-lg mb-2 mb-sm-0 disabled" style="font-size:0.8rem"
                                                       href="{{ route('subjects.info', ['id' => $subject->id]) }}" role="button">Információk
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">Jegy módosítása</button>
                                                    @if ($errors->has('grade'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('grade') }}</strong>
                                                        </div>
                                                    @endif
                                                </form>
                                            @else
                                                <p class="card-subtitle mb-2 text-muted"> Elért érdemejgy: 
                                                    <span style="font-size: 1.3rem;font-weight:bold">{{$subject->pivot->grade}}</span>
                                                </p>
                                                <a class="btn btn-primary btn-lg mb-2 mb-sm-0 disabled" style="font-size:0.8rem"
                                                   href="{{ route('subjects.info', ['id' => $subject->id]) }}" role="button">Információk
                                                </a>
                                                <a class="btn btn-primary btn-lg disabled" style="font-size:0.8rem" target="_blank"
                                                    href="{{ route('newsubject.edit', ['id' => $subject->id]) }}" 
                                                    role="button">Jegy szerkesztése
                                                </a>
                                            @endif
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
        </div>
    </div>
@endsection
