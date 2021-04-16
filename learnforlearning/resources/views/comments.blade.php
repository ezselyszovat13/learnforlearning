@extends('layouts.app')

@section('title', 'Beérkezett megjegyzések')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Beérkezett megjegyzések</h1>
            <hr class="my-4">
            <p style="font-size: 1.2rem;">A következő oktatóról: <span style="font-size: 1.5rem;font-weight:bold">{{$teacher->name}}</span></p>
            @forelse ($comments as $author => $data)
                @if($data['comment'] !== null)
                <div class="mb-2">
                    <div class="card">
                        <p class="card-header {{$data['is_positive_vote'] ? 'bg-success' : ''}} {{(!$data['is_positive_vote'] && $data['is_positive_vote'] !== null) ? 'bg-danger' : ''}}">
                            Szerző: <span style="font-size: 1.3rem;font-weight:bold"> {{ $author }} </span>
                        </p>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $data['comment'] }}</h6>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div role='alert' class="alert alert-danger">
                    <p>Még nem érkeztek kommentek az oktatóra!</p>
                </div>
            @endforelse
            @if(!$was_comment && count($comments)>0)
                <div role='alert' class="alert alert-danger">
                    <p>Még nem érkeztek kommentek az oktatóra!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
