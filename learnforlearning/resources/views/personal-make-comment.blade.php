@extends('layouts.app')

@section('title', 'Megjegyzés megváltoztatása')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Megjegyzés megváltoztatása</h1>
            <hr class="my-4">
            <p style="font-size: 1.2rem;"><span style="font-size: 1.5rem;font-weight:bold">{{$teacher->name}}</span> oktatóról</p>
            <form action="{{route('personal.comment.update')}}" method="POST">
                @csrf
                <input type="hidden" name="teacherId" value="{{ $teacher->id }}">
                <label for="comment" class="text-md-right mr-4">Ide írhatod a megjegyzést az oktatóról:</label>
                <textarea type="text" rows="5" cols="80" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" id="comment" name="comment">{{ isset($comment) ? $comment : old('comment') }}</textarea>
                @if ($errors->has('comment'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('comment') }}</strong>
                    </div>
                @endif
                <div class="container">
                    <div class="row">
                        <button type="submit" class="btn btn-primary mt-2 ml-auto">Megjegyzés elküldése</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection