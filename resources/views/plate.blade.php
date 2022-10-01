@extends('layouts.dash')

@section('content')
    <div>
        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'manufacturer')
            <div class="card">
                <h5 class="card-header">{{ __('Plate Size') }}</h5>
                <div class="card-body">
                    <table>
                        <tr>
                            <th>#</th>
                            <th>Dimensions</th>
                        </tr>
                        @foreach ($platedims as $platedim)
                            <tr>
                                <td>{{ $platedim->id }}</td>
                                <td>{{ $platedim->dimensions }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="card">
                <h5 class="card-header">{{ __('Plate Color') }}</h5>
                <div class="card-body">
                    <table>
                        <tr>
                            <th>#</th>
                            <th>Color</th>
                        </tr>
                        @foreach ($Platecolors as $Platecolor)
                            <tr>
                                <td>{{ $Platecolor->id }}</td>
                                <td>{{ $Platecolor->color }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="card">
                <h5 class="card-header">{{ __('All Plates') }}</h5>
                <div class="card-body">
                </div>
            </div>
        @else
            <div class="card">
                <h5 class="card-header">{{ __('All Plates') }}</h5>
                <div class="card-body">
                </div>
            </div>
        @endif
    </div>
    <hr>
@endsection
