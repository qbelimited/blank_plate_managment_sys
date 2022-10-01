@extends('layouts.dash')

@section('content')
    <div>
        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'manufacturer')
            <div class="card">
                <h5 class="card-header">{{ __('Plate Size') }}</h5>
                <div class="card-body">
                    @if (!empty($platedims))
                        <table class="table table-hover table-sm table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Dimensions</th>
                            </tr>
                            @foreach ($platedims as $platedim)
                                <tr>
                                    <td>{{ $platedim->id }}</td>
                                    <td>{{ $platedim->description }}</td>
                                    <td>{{ $platedim->dimensions }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h1>No data available yet</h1>
                    @endif
                </div>
            </div>
            <br>
            <div class="card">
                <h5 class="card-header">{{ __('Plate Color') }}</h5>
                <div class="card-body">
                    @if (!empty($platecolors))
                        <table class="table table-hover table-sm table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Color</th>
                            </tr>
                            @foreach ($platecolors as $platecolor)
                                <tr>
                                    <td>{{ $platecolor->id }}</td>
                                    <td>{{ $platecolor->color }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h1>No data available yet</h1>
                    @endif
                </div>
            </div>
            <br>
            <div class="card">
                <h5 class="card-header">{{ __('All Plates') }}</h5>
                <div class="card-body">
                    <table class="table table-hover table-sm table-bordered data-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Manufacturer Serial #</th>
                                <th scope="col" style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <script type="text/javascript">
                                $(function() {

                                    var table = $('.data-table').DataTable({
                                        processing: true,
                                        serverSide: true,
                                        ajax: "{{ route('plate') }}",
                                        columns: [{
                                                data: 'id',
                                                name: 'id'
                                            },
                                            {
                                                data: 'color',
                                                name: 'color'
                                            },
                                            {
                                                data: 'size',
                                                name: 'email'
                                            },
                                            {
                                                data: 'serial_number_id',
                                                name: 'serial_number_id'
                                            },
                                            {
                                                data: 'action',
                                                name: 'action',
                                                orderable: false,
                                                searchable: false
                                            },
                                        ]
                                    });

                                });
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <br>
            <div class="card">
                <h5 class="card-header">{{ __('All Plates') }}</h5>
                <div class="card-body">
                    <table class="table table-hover table-sm table-bordered data-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Manufacturer Serial #</th>
                                <th scope="col" style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <script type="text/javascript">
                                $(function() {

                                    var table = $('.data-table').DataTable({
                                        processing: true,
                                        serverSide: true,
                                        ajax: "{{ route('plate') }}",
                                        columns: [{
                                                data: 'id',
                                                name: 'id'
                                            },
                                            {
                                                data: 'color',
                                                name: 'color'
                                            },
                                            {
                                                data: 'size',
                                                name: 'email'
                                            },
                                            {
                                                data: 'serial_number_id',
                                                name: 'manufacturer serial number'
                                            },
                                            {
                                                data: 'action',
                                                name: 'action',
                                                orderable: false,
                                                searchable: false
                                            },
                                        ]
                                    });

                                });
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    <hr>
@endsection
