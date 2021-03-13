@extends('layouts.app')

@section('title', 'Adatok')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Kurzusok</h1>
            <p class="lead">Itt láthatod, hogy milyen tárgyakat végezhetsz egyetemi tanulmányaid során, melyek nem a szabadon választható kategóriába tartoznak!</p>
            @if(isset($subjects))
                @if(count($subjects)!=0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kurzus neve</th>
                                <th scope="col">Kurzus kódja</th>
                                <th scope="col">Páros féléves tárgy</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($subjects as $subject)
                                    
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->code}}</td>
                                @if($subject->even_semester)
                                    <td>IGEN</td>
                                @else
                                    <td>NEM</td>
                                @endif
                                <td><a class="btn btn-primary btn-lg" target="_blank" href="{{$subject->url}}" role="button">Információk</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <p>Nincsenek megjeleníthető kurzusok</p>
                @endif
            @else
                <p>Nincsenek megjeleníthető kurzusok</p>
            @endif
        </div>
    </div>
@endsection
