@extends('layouts.app')

@section('content')
    <style>
        .buttons {
            width: 200px;
            margin: 0 auto;
            display: inline;
        }

        .action_btn {
            width: 200px;
            margin: 0 auto;
            display: inline;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Super Admin Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="buttons">

                            <div class="action_btn">

                                <button name="submit" class="action_btn submit" type="submit" value="Save"
                                    onclick="myFunction()">Production</button>
                                <button name="submit" class="action_btn cancel" type="submit" value="Cancel"
                                    onclick="myFunction2()">Deliveries</button>

                                <p id="saved"></p>

                            </div>

                        </div>
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
