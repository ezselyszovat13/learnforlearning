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
            @if (session()->has('teacher_not_existed'))
                @if (session()->get('teacher_not_existed') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        A kommentolvasáshoz használt oktató nem létezik!
                    </div>
                @endif
            @endif
            <div class="container">
                <div class="row">
                    <div class="form-group form-inline">
                        <label for="search">Keress tárgyra: </label>
                        <input type="text" class="form-control ml-2" id="searchInput" placeholder="Tárgynév">
                    </div>
                </div>
            </div>
            @if(isset($subjects))
                @if(count($subjects)!=0)
                    <div class="container" style="padding-left: 0px;">
                        <div class="row" id="subject_container">
                            @foreach ($subjects as $subject)
                                <div class="mb-2 col-md-4" style="padding-left: 0px;">
                                    <div class="card h-100">
                                        <p class="card-header">
                                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $subject->name }} </span>
                                               {{ $subject->code}}
                                        </p>
                                        <div class="card-body">
                                            @if($subject->even_semester)
                                                <p class="card-subtitle mb-2 text-muted">A tárgy féléve: PÁROS</p>
                                            @else
                                                <p class="card-subtitle mb-2 text-muted">A tárgy féléve: PÁRATLAN</p>
                                            @endif
                                            <a class="btn btn-secondary btn-lg" href="{{ route('subjects.info', 
                                                      ['id' => $subject->id, 'page' => 'subjects']) }}"
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

    <script>
        $(document).ready(function () {
            $('#searchInput').keyup(function () { 
                $.ajaxSetup({
                    beforeSend: function(xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
               });
               $.ajax({
                  url: "{{ url('/subjects/filter') }}",
                  type: 'POST',
                  data: {
                     text: jQuery('#searchInput').val()
                  },
                  success: function(result){
                      subjectsHTML = "";
                      result.forEach(subject => {
                        subjectsHTML += `<div class="mb-2 col-md-4" style="padding-left: 0px;">
                                        <div class="card h-100">
                                            <p class="card-header">
                                                <span style="font-size: 1.3rem;font-weight:bold" class="mr-1"> `+ subject.name + 
                                                `</span>` + subject.code +
                                            `</p>
                                            <div class="card-body">`;
                        
                        if(subject.even_semester)
                            subjectsHTML += `<p class="card-subtitle mb-2 text-muted">A tárgy féléve: PÁROS</p>`;
                        else
                            subjectsHTML += `<p class="card-subtitle mb-2 text-muted">A tárgy féléve: PÁRATLAN</p>`;
                                                
                        subjectsHTML += `<a class="btn btn-secondary btn-lg" href="/subjects/`+subject.id+`?page=subjects"
                                                    role="button">Információk</a></div></div></div>`;
                      });
                      $('#subject_container').html(subjectsHTML);
                  },
                  error: function (data, textStatus, errorThrown) {
                    console.log(data);
                  }
                });
            });
        });
    </script>
@endsection
