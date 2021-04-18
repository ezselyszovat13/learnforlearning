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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kurzus neve</th>
                                <th scope="col">Kurzus kódja</th>
                                <th scope="col">Páros féléves tárgy</th>
                                <th scope="col">Érdemjegy</th>
                                <th scope="col"></th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($user_subjects as $subject)
                            <tr>
                                @if($subject->id === $subject_to_update->id)
                                <form action="{{ route('newsubject.update', ['id' => $subject->id]) }}" method="POST">
                                    @csrf
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$subject->name}}</td>
                                    <td>{{$subject->code}}</td>
                                    @if($subject->even_semester)
                                        <td>IGEN</td>
                                    @else
                                        <td>NEM</td>
                                    @endif
                                    <td>
                                       <input type="text" class="{{ $errors->has('grade') ? 'is-invalid' : '' }}" id="grade" 
                                        name="grade" value="{{ old('grade') ? old('grade') : $grade}}">
                                    </td>
                                    <td>
                                      <a class="btn btn-primary btn-lg disabled" style="font-size:0.8rem" target="_blank"
                                         href="{{$subject->url}}" role="button">Információk
                                      </a>
                                    </td>
                                    <td><button type="submit" class="btn btn-primary">Jegy módosítása</button></td>
                                </form>
                                @else
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$subject->name}}</td>
                                    <td>{{$subject->code}}</td>
                                    @if($subject->even_semester)
                                        <td>IGEN</td>
                                    @else
                                        <td>NEM</td>
                                    @endif
                                    <td>{{$subject->pivot->grade}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-lg disabled" style="font-size:0.8rem" target="_blank" 
                                           href="{{$subject->url}}" role="button">Információk
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-lg disabled" style="font-size:0.8rem" target="_blank"
                                           href="{{ route('newsubject.edit', ['id' => $subject->id]) }}" 
                                           role="button">Jegy szerkesztése
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    @if ($errors->has('grade'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('grade') }}</strong>
                        </div>
                    @endif
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
