@extends('layouts.app')

@section('title', 'Javítási észrevételek')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Javítási észrevételek küldése</h1>
            <p class="lead">
                A következőkben a szoftver használata közben felmerült problémáidat jelezheted a fejlesztők felé. Ehhez rendelkezésre
                bocsátunk sablonokat, mellyel könnyebben tudjuk majd helyrehozni a felmerülő rendellenességeket.
            </p>
            <hr class="my-4">
            <div>
                @if (session()->has('activity_changed'))
                    @if (session()->get('activity_changed') == true)
                        <div class="alert alert-success mb-3" role="alert">
                            Az aktivitás megváltoztatásának kérelme sikeresen leadva!
                        </div>
                    @else
                        <div class="alert alert-danger mb-3" role="alert">
                            Az aktivitás megváltoztatásának kérelme meghiúsult!
                        </div>
                    @endif
                @endif
                <h2>Egy, már meglévő oktató aktivitásának változása</h2>
                <p>
                    Ebben a funkcióban jelezheted azt, hogy egy, az alkalmazásban szereplő oktató aktivitási státusza megváltozott,
                     mely azonban az alkalmazásban nem tükröződik még.
                    Fontos! Attól, hogy Te ezt jelzed felénk, addig nem lehetünk teljesen biztosak a dologban, míg más valaki 
                    nem jelentkezik ugyanezzel a problémával, így a javítás idejéért elnézésedet kérjük!
                </p>

                <form action="{{route('fixable.activity')}}" method="POST">
                    @csrf
                    <div class="form-group form-inline">
                        <label for="subject" class="text-md-right mr-4">Kurzus: </label>
                        <select id="subject" name="subject" class="form-control 
                            {{ $errors->has('subject') ? 'is-invalid' : '' }}" autofocus>
                            <option value="">Válassz opciót!</option>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}" {{ (old('subject') == $subject->id ? 'selected':'') }}>
                                    {{$subject->name}}
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
                        <label for="teacher" class="text-md-right mr-4">Oktató: </label>
                        <select id="teacher" name="teacher" class="form-control 
                            {{ $errors->has('teacher') ? 'is-invalid' : '' }} mr-4" autofocus>
                            <option value="">Válassz kurzust!</option>
                        </select>
                        @if ($errors->has('teacher'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('teacher') }}</strong>
                            </div>
                        @endif
                        <div class="my-3 mr-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active">
                                <label class="form-check-label" for="is_active">
                                    Aktív
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Elküld</button>
                    </div>
                </form>
            </div>
            <hr class="my-4">
            @if (session()->has('teacher_recommend_added'))
                    @if (session()->get('teacher_recommend_added') == true)
                        <div class="alert alert-success mb-3" role="alert">
                            Az oktatóhozzáadási kérelem sikeresen leadva!
                        </div>
                    @endif
            @endif
            <div>
                <h2>Új oktató ajánlása</h2>
                <p>
                    Ebben a funkcióban jelezheted azt, hogy az adott tárgynál egy oktató oktat, ugyanakkor ezen tanár nem 
                    szerepel adatbázisunkban. Fontos! Attól, hogy Te ezt jelzed felénk, addig nem lehetünk teljesen biztosak a 
                    dologban, míg más valaki nem jelentkezik ugyanezzel a problémával, így a javítás idejéért elnézésedet kérjük!
                </p>
                <form action="{{route('fixable.newteacher')}}" method="POST">
                    @csrf
                    <div class="form-group form-inline">
                        <label for="subject2" class="text-md-right mr-4">Kurzus: </label>
                        <select id="subject2" name="subject2" class="form-control 
                            {{ $errors->has('subject2') ? 'is-invalid' : '' }}" autofocus>
                            <option value="">Válassz opciót!</option>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}" {{ (old('subject2') == $subject->id ? 'selected':'') }}>
                                    {{$subject->name}}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('subject2'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('subject2') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-inline">
                        <label for="tname" class="text-md-right mr-4">Oktató neve: </label>
                        <input type="text" class="mr-4 form-control {{ $errors->has('tname') ? 'is-invalid' : '' }}" 
                               id="tname" name="tname" value="{{ old('tname') ? old('tname') : ''}}">
                        @if ($errors->has('tname'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('tname') }}</strong>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-secondary">Elküld</button>
                    </div>
                </form>
            </div>
            <hr class="my-4">
            <div>
                @if (session()->has('subject_recommend_added'))
                        @if (session()->get('subject_recommend_added') == true)
                            <div class="alert alert-success mb-3" role="alert">
                                Az tárgyhozzáadási kérelem sikeresen leadva!
                            </div>
                        @endif
                @endif
                <h2>Új kurzus ajánlása</h2>
                <p>
                    Ebben a funkcióban jelezheted azt, hogy te észrevettél egy új tárgyat, mely a specializációhoz kapcsolható, 
                    ugyanakkor ezen kurzus nem szerepel adatbázisunkban. Fontos! Attól, hogy Te ezt jelzed felénk, addig nem 
                    lehetünk teljesen biztosak a dologban, míg más valaki nem jelentkezik ugyanezzel a problémával, így a javítás
                    idejéért elnézésedet kérjük!
                </p>

                <form action="{{route('fixable.newsubject')}}" method="POST">
                    @csrf
                    <div class="form-group form-inline">
                        <label for="sname" class="text-md-right mr-4">Kurzus neve: </label>
                        <input type="text" class="mr-4 form-control col-md-6 {{ $errors->has('sname') ? 'is-invalid' : '' }}" 
                               id="sname" name="sname" value="{{ old('sname') ? old('sname') : ''}}">
                        @if ($errors->has('sname'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('sname') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-inline">
                        <label for="code" class="text-md-right mr-4">Kurzus kódja: </label>
                        <input type="text" class="mr-4 form-control col-md-6 {{ $errors->has('code') ? 'is-invalid' : '' }}"
                               id="code" name="code" value="{{ old('code') ? old('code') : ''}}">
                        @if ($errors->has('code'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('code') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="existsA" id="existsA">
                            <label class="form-check-label mr-4" for="existsA"> Létezik A szakirányon </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="existsB" id="existsB">
                            <label class="form-check-label mr-4" for="existsB"> Létezik B szakirányon </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="existsC" id="existsC">
                            <label class="form-check-label" for="existsC"> Létezik C szakirányon </label>
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="optionalA" id="optionalA">
                            <label class="form-check-label mr-4" for="optionalA"> Opcionális A szakirányon </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="optionalB" id="optionalB">
                            <label class="form-check-label mr-4" for="optionalB"> Opcionális B szakirányon </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="optionalC" id="optionalC">
                            <label class="form-check-label" for="optionalC"> Opcionális C szakirányon </label>
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label for="credit" class="text-md-right mr-4">Kreditérték: </label>
                        <input type="text" class="mr-4 form-control col-md-4 {{ $errors->has('credit') ? 'is-invalid' : '' }}"
                               id="credit" name="credit" value="{{ old('credit') ? old('credit') : ''}}">
                        @if ($errors->has('credit'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('credit') }}</strong>
                            </div>
                        @endif
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="evenSemester" id="evenSemester">
                            <label class="form-check-label mr-4" for="evenSemester"> Páros féléves tárgy </label>
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label for="url" class="text-md-right mr-4">URL (további információk): </label>
                        <input type="text" class="mr-4 form-control col-md-6 {{ $errors->has('url') ? 'is-invalid' : '' }}"
                               id="url" name="url" value="{{ old('url') ? old('url') : ''}}">
                        @if ($errors->has('url'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('url') }}</strong>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-secondary">Elküld</button>
                </form>
            </div>
            
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#subject').change(function () { 
                $.ajaxSetup({
                    beforeSend: function(xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
               });
               $.ajax({
                  url: "{{ url('/fixable/teachers') }}",
                  type: 'GET',
                  data: {
                     subject_id: jQuery('#subject option:selected').val()
                  },
                  success: function(result){
                      options = "";
                      result.forEach(teacher => {
                        options += `<option value="`+teacher.id+`">`+teacher.name+`</option>`
                      });
                      if(options == "")
                        options += '<option value="">Ehhez a tárgyhoz nem ismertek oktatók!</option>';
                      $('#teacher').html(options);
                  },
                  error: function (data, textStatus, errorThrown) {
                    console.log(data);
                  }
                });
            });
        });
    </script>
@endsection
