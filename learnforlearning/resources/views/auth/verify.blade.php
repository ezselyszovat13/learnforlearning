@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Erősítsd meg az e-mail címed</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Az aktivációs link elküldésre került a megadott címre.
                        </div>
                    @endif

                    Mielőtt továbblépnél, kérlek aktiváld a fiókod a megadott e-mail címen.
                    Amennyiben nem kaptál e-mailt, 
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"> kattins ide egy új igényléséért</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
