@extends('layouts.app')

@section('title', 'Kalkuláció')

@section('content')
    <style>
    .fill {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden
    }
    .fill img {
        flex-shrink: 0;
        min-width: 100%;
        min-height: 100%
    }
    </style>

    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Kötelezően választható tárgy keresése</h1>
            <hr class="my-4">
            <div class="container">
                <div class="row">
                    <h2 class="mx-auto">A számodra még elérhető kötelezően választható tárgyak</h2>
                </div>
            </div>
            <div>
                @if(isset($optional_subjects))
                    @forelse ($optional_subjects as $subject)
                        <span class="badge badge-primary">
                            <a style="color: white !important;font-size:14px" 
                               href="{{ route('subjects.info', ['id' => $subject->id]) }}">{{ $subject->name }}
                            </a>
                        </span>
                    @empty
                        <div class="alert alert-danger mb-3" role="alert">
                            Válassz szakirányt, hogy kalkulálhass!
                        </div>
                    @endforelse
                @else
                    <div class="alert alert-danger mb-3" role="alert">
                        Válassz szakirányt, hogy kalkulálhass!
                    </div>
                @endif
            </div>
            <hr class="my-4">
            @if (session()->has('calculations_deleted'))
                @if (session()->get('calculations_deleted') == true)
                    <div id="calcs_deleted" class="alert alert-danger mt-3" role="alert">
                        A korábbi kalkulációk törlésre kerültek!
                    </div>
                @endif
            @endif
            <div class="container">
                <div class="row">
                    <h2 class="mx-auto">A számodra korábban kalkulált kurzusok</h2>
                </div>
            </div>
            <div>
                <table class="table table-striped" style="{{count($calculation_history)===0 ? 'display:none' : ''}}" id="calc_table">
                    <thead>
                        <tr id="calc_header" style="{{count($calculation_history)===0 ? 'display:none' : ''}}">
                            <th scope="col"></th>
                            <th scope="col">Kurzus neve</th>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($calculation_history)!==0)
                            @foreach ($calculation_history as $element)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $sub_data[$element->subject_code]['name'] }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank" 
                                        href="{{ $sub_data[$element->subject_code]['url'] }}" role="button">Információk
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="container" id="calc_delete_div" style="{{count($calculation_history)===0 ? 'display:none' : ''}}">
                    <div class="row">
                        <a class="btn btn-primary btn-lg ml-auto" href="{{route('findsubject.delete')}}" 
                           role="button">Korábbi kalkulációk törlése
                        </a>
                    </div>
                </div>
            </div>           
            @if(count($calculation_history)===0)
                <div id="calc_not_used" class="alert alert-danger mb-3" role="alert">
                    Még nem használtad a kalkulációs funkciót!
                </div>
            @endif
            <hr class="my-4">
            <p class="lead">A "Kalkulál" gombra kattintva megtudhatod, hogy melyik lenne számodra a legkedvezőbb kötelezően 
                választható tárgy a kiválasztott félévre.
            </p>
            <div class="container">
                <div class="row">
                    <label for="semester" class="mr-4 mt-2">Aktuális félév: </label>
                    <select id="semester" name="semester" class="mr-4 col-md-4 form-control {{ $can_calculate ? '' : 'disabled' }}
                        {{ $errors->has('semester') ? 'is-invalid' : '' }}" style="{{ $can_calculate ? '' : 'pointer-events: none;' }}" {{$can_calculate ? 'autofocus' : ''}}>
                        <option value="1">Ősszel induló félév</option>
                        <option value="2">Tavasszal induló félév</option>
                    </select>
                    <button id="calc_button" type="submit" class="btn btn-primary {{ $can_calculate ? '' : 'disabled' }} mr-auto" 
                            style="{{ $can_calculate ? '' : 'pointer-events: none;' }}">Kalkulál
                    </button>
                </div>
            </div>
            <div id="calc_successed" style="display:none" class="alert alert-success mt-3" role="alert">
                A következő tárgy javasolandó: <div id="calc_result" style="display:inline-block"></div>
            </div>

            <div id="calc_failed" style="display:none" class="alert alert-danger mb-3" role="alert">
                Számodra nincs megfelelő kötelezően választható tárgy!
            </div>

            @if(!$can_calculate)
                <p style="color:red" class="mt-3">Kérlek válassz szakirányt, hogy kalkulálni tudjunk a számodra!</p>
            @endif
            <div class="container" id="load_container" style="display:none">
                <div class="row">
                    <div id="calc_label" style="padding-top:40px;color:red;font-weight:bold">A kalkuláció folyamatban van!</div>
                    <span class="fill" style="height:100px;width:100px;" id="loading"></span>  
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
         $(document).ready(function() {
            $('#calc_button').click(function(e){
               e.preventDefault();
               $('#load_container').show();
               $('#loading').html('<img style="height:25%" src="http://rpg.drivethrustuff.com/shared_images/ajax-loader.gif"/>');
               $('#calc_result').html('');
               $('#calc_failed').hide();
               $('#calc_successed').hide();
               $.ajaxSetup({
                    beforeSend: function(xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
               });
               $.ajax({
                  url: "{{ url('/findsubject/calculate') }}",
                  type: 'POST',
                  data: {
                     semester: jQuery('#semester').val()
                  },
                  success: function(result){
                     $('#loading').html('');
                     $('#load_container').hide();
                     if(result['isSuccessful'] === false){
                         $('#calc_failed').show();
                         $('#calc_successed').hide();
                     }
                     else{
                        $('#calc_result').html(result['subject'].name);
                        $('#calc_failed').hide();
                        $('#calc_successed').show();

                        calcHistory = '';
                        result_name = result['subject'].name;
                        result_url = result['subject'].url;
                        if($('#calc_table').css('display') == 'none'){
                            $('#calc_table').removeAttr("style");
                            $('#calc_header').removeAttr("style");
                            $('#calc_delete_div').removeAttr("style");
                            $('#calc_not_used').css('display','none');
                            $('#calcs_deleted').css('display','none');
                            console.log($('#calc_table').html());
                        }
                        console.log("MÁSODIK");
                        parts = $('#calc_table').html().split("</tbody>");
                        calcHistory = parts[0];
                        calcHistory += 
                            `<tr>
                                <td>NEW</td>
                                <td>`+result_name+`</td>
                                <td>
                                    <a class="btn btn-primary btn-lg" style="font-size:0.8rem" target="_blank" 
                                        href="`+result_url+`" role="button">Információk
                                    </a>
                                </td>
                            </tr>`;
                        calcHistory += parts[1];
                        $('#calc_table').html(calcHistory);
                     }

                  },
                  error: function (data, textStatus, errorThrown) {
                    console.log(data);
                  }
                });
            });
        })
    </script>
@endsection
