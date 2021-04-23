@extends('layouts.app')

@section('title', 'Specializáció módosítása')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Specializáció módosítása</h1>
            <hr class="my-4">
            @if(isset($user))
                <form action="{{ route('spec.update', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="spec" class="text-md-right mr-4">Specializáció </label>
                    <select id="spec" name="spec" class="mr-4 col-sm-4 form-control 
                        {{ $errors->has('spec') ? 'is-invalid' : '' }}" autofocus>
                        <option value="A" {{$old_spec == 'A' ? 'selected':''}}>A szakirány</option>
                        <option value="B" {{$old_spec == 'B' ? 'selected':''}}>B szakirány</option>
                        <option value="C" {{$old_spec == 'C' ? 'selected':''}}>C szakirány</option>
                        <option value="NOTHING" {{$old_spec == 'NOTHING' ? 'selected':''}}>Még nem választottam</option>
                    </select>
                    </div>
                    <td><button type="submit" class="btn btn-primary">Specializáció módosítása</button></td>
                </form>
            @else
                <div role='alert' class="alert alert-danger">
                    <p>Nem létező felhasználó!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
