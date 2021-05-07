@extends('layouts.app')

@section('title', 'Megjegyzés megadása')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Megjegyzés megadása
                <a class="btn btn-secondary btn-lg" href="{{ route('subjects.info', ['id' => $subject->id, 'page' => isset($page) ? 
                          $page : null]) }}" role="button">Mégsem</a>
            </h1>
            <hr class="my-4">
            <p style="font-size: 1.2rem;"><span style="font-size: 1.5rem;font-weight:bold">{{$teacher->name}}</span> oktatóról, 
               a(z) <span style="font-size: 1.5rem;font-weight:bold">{{$subject->name}}</span> tárgy keretében
                <a class="btn btn-secondary ml-3" style="font-size:0.6rem"
                    href="{{ route('delete.comment', ['teacherId' => $teacher->id, 'subjectId' => $subject->id, 'page' => isset($page) ? 
                          $page : null]) }}" 
                    role="button"> Megjegyzés törlése
                </a>
            </p>
            <form action="{{ route('user.comment.update', ['teacherId' => $teacher->id, 'subjectId' => $subject->id, 
                          'page' => isset($page) ? $page : null]) }}" 
                  method="POST">
                @csrf
                <label for="comment" class="text-md-right mr-4">Ide írhatod a megjegyzést az oktatóról:</label>
                <textarea type="text" rows="5" cols="80" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
                          id="comment" name="comment">{{ isset($comment) ? $comment : old('comment') }}</textarea>
                @if ($errors->has('comment'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('comment') }}</strong>
                    </div>
                @endif
                <div class="container">
                    <button type="submit" class="btn btn-secondary mt-2">Megjegyzés elküldése</button>
                </div>
            </form>
        </div>
    </div>
@endsection
