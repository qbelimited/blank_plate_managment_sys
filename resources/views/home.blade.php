@extends('layouts.dash')

@section('content')
    <div>
        <div class="card">
            <h5 class="card-header">{{ __('Super Admin Dashboard') }}</h5>
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

                <div class="row align-items-center">
                    <div class="col-auto">
                        <canvas id="piechart"></canvas>
                    </div>
                    <div class="col-auto">
                        <canvas id="linech"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
