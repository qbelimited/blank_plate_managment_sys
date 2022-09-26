@extends('layouts.dash')

@section('content')
    <div>
        <div class="card">
            <h5 class="card-header">{{ __('Super Admin Dashboard') }}</h5>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
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
