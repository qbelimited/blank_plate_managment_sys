@extends('layouts.dash')

@section('content')
    <div>
        <div class="card">
            <h5 class="card-header">{{ __('Manufacturer Dashboard') }}</h5>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                @if (!empty(session('successMsg')))
                    <div class="alert alert-success"> {{ session()->get('successMsg') }}
                        {{ session()->forget('successMsg') }}</div>
                @endif
                @if (!empty(session('errorMsg')))
                    <div class="alert alert-danger"> {{ session()->get('errorMsg') }}
                        {{ session()->forget('errorMsg') }}</div>
                @endif

                {{ __('You are logged in!') }}
                <br>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <hr>
@endsection
