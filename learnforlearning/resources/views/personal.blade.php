@extends('layouts.app')

@section('title', 'Adatok')

@section('content')
    <div class="container">
        <div class="jumbotron">
            @if (session()->has('spec_updated'))
                @if (session()->get('spec_updated') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A specializáció módosítása sikeresen megtörtént!
                    </div>
                @endif
            @endif
            @if (session()->has('user_cannot_be_edited'))
                @if (session()->get('user_cannot_be_edited') == true)
                    <div class="alert alert-danger mb-3" role="alert">
                        Más felhasználó beállításait nem szerkesztheted!
                    </div>
                @endif
            @endif

            <h1 class="display-4">Adatok</h1>
            <p class="lead">Itt láthatóak a megadott személyes adataid, valamint egyéb kalkulált eredményeid!</p>
            <hr class="my-4">
            <div>
                <p style="font-size: 1.2rem;">Megadott név: 
                    <span style="font-size: 1.5rem;font-weight:bold">{{$user->name}}</span>
                </p>
            </div>
            <div>
                <p style="font-size: 1.2rem;">
                @if($user->spec !== 'NOTHING')
                    Szakirány: <span style="font-size: 1.5rem;font-weight:bold">{{$user->spec}}</span>
                @else
                    <span style="font-size: 1.5rem;font-weight:bold"> Még nem választottál szakirányt </span>
                @endif</p>
            </div>
            <div>
                @if($user->getGradesCount() !== 0)
                    <p style="font-size: 1.2rem;">
                        Jelenleg <span style="font-size: 1.5rem;font-weight:bold"> {{ $user->getGradesCount()}} </span> 
                        darab eredményt vettél fel az alkalmazásban, melyek átlaga: 
                        <span style="font-size: 1.5rem;font-weight:bold"> 
                            {{ $user->getGradesCount() != 0 ? round($user->getGradesAverage(),2) : '-'}} 
                        </span>
                    </p>
                    
                    <p style="font-size: 1.2rem;">
                        Ebből <span style="font-size: 1.5rem;font-weight:bold"> {{ $user->getOptionalGradesCount()}} </span> 
                        darab tárgy volt kötelezően választható, melyek átlaga: 
                        <span style="font-size: 1.5rem;font-weight:bold"> 
                            {{ $user->getOptionalGradesCount() != 0 ? round($user->getOptionalGradesAverage(),2) : '-'}} 
                        </span>
                    </p>

                    <p style="font-size: 1.2rem;">Eddig <span style="font-size: 1.5rem;font-weight:bold"> 
                    {{$user->getAcquiredCredits()}} </span> kreditet szereztél.</p>
                @else
                    <p style="font-size: 1.5rem;font-weight:bold">Jelenleg még nincs rögzített érdemjegyed!</p>
                @endif
            </div>
            <a class="btn btn-secondary btn-lg" href="{{ route('spec.edit', ['id' => $user->id]) }}" 
               role="button">Szakirány módosítása
            </a>
    
            <hr class="my-4">
            @if (session()->has('comment_updated'))
                @if (session()->get('comment_updated') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A megjegyzés sikeresen megváltoztatva!
                    </div>
                @endif
            @endif
            <h2>Az oktatókról írt megjegyzéseid</h2>
            @if (session()->has('comment_deleted'))
                @if (session()->get('comment_deleted') == true)
                    <div class="alert alert-success mb-3" role="alert">
                        A megjegyzés sikeresen eltávolítva!
                    </div>
                @else
                    <div class="alert alert-danger mb-3" role="alert">
                        A megjegyzés eltávolítása sikertelen volt!
                    </div>
                @endif
            @endif
            @forelse ($comments as $key => $data)
                @if($data['comment'] !== null)
                <div class="mb-2">
                    <div class="card">
                        <p id="{{'c'.$key}}" class="card-header {{$data['is_positive_vote'] ? 'bg-success' : ''}} 
                                  {{(!$data['is_positive_vote'] && $data['is_positive_vote'] !== null) ? 'bg-danger' : ''}}">
                            Véleményezett oktató: 
                            <span style="font-size: 1.3rem;font-weight:bold"> {{ $data['teacher_name'] }} </span>
                            <a class="btn btn-secondary ml-3" style="font-size:0.6rem"
                                href="{{ route('personal.delete.comment', ['teacherId' => $key]) }}" 
                                role="button"> Megjegyzés törlése
                            </a>
                        </p>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $data['comment'] }}</h6>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div role='alert' class="alert alert-danger">
                    <p>Még nem írtál megjegyzéseket!</p>
                </div>
            @endforelse
            @if(!$was_comment && count($comments)>0)
                <div role='alert' class="alert alert-danger">
                    <p>Még nem írtál megjegyzéseket!</p>
                </div>
            @endif

            <hr class="my-4">
            <h2>Az oktatókra leadott szavazataid</h2>
            @forelse ($comments as $key => $data)
                @if($data['is_positive_vote'] !== null)
                    <span id="{{'s'.$key}}" class="badge badge-light mb-2 col-md-3">
                        <p> {{$data['teacher_name']}} </p>
                        <span id="{{'l'.$key}}" style="{{ $data['is_positive_vote'] ? 'opacity:1' : 'opacity:0.5' }}">
                            <span class="btn btn-lg voter pos" data-id="{{$key}}">👍</span>
                        </span>
                        <span id="{{'d'.$key}}" style="{{ !$data['is_positive_vote'] ? 'opacity:1' : 'opacity:0.5' }}">
                            <span class="btn btn-lg voter neg" data-id="{{$key}}" >💔</span>
                        </span>
                    </span>
                @endif
            @empty
                <div role='alert' class="alert alert-danger">
                    <p>Még nem szavaztál oktatóra!</p>
                </div>
            @endforelse
            @if($was_like)
            @endif
            @if(!$was_like && count($comments)>0)
                <div role='alert' class="alert alert-danger">
                    <p>Még nem szavaztál oktatóra!</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.voter').click(function () { 
                teacher_id = $(this).data("id");
                is_pos = $(this).hasClass("pos") ? 1 : 0;
                $.ajaxSetup({
                    beforeSend: function(xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
               });
               $.ajax({
                  url: "{{ url('/subject/vote/') }}",
                  type: 'GET',
                  data: {
                     teacherId: teacher_id,
                     isPositive: is_pos
                  },
                  success: function(result){
                     if(!result.is_successful)
                        return

                     if(result.state === "1"){
                         $("#l"+teacher_id).css('opacity',1);
                         $("#d"+teacher_id).css('opacity',0.5);
                         $("#c"+teacher_id).removeClass('bg-danger');
                         $("#c"+teacher_id).addClass('bg-success');
                     }
                     else if(result.state === "0"){
                         $("#l"+teacher_id).css('opacity',0.5);
                         $("#d"+teacher_id).css('opacity',1);
                         $("#c"+teacher_id).removeClass('bg-success');
                         $("#c"+teacher_id).addClass('bg-danger');
                     }
                     else{
                         $("#s"+teacher_id).css('display','none');
                         $("#c"+teacher_id).removeClass('bg-danger');
                         $("#c"+teacher_id).removeClass('bg-success');
                     }
                  },
                  error: function (data, textStatus, errorThrown) {
                     console.log(data);
                  }
                });
            });
        });
    </script>
@endsection
