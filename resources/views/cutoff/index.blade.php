<x-admin>
    @section('title', 'CUT OFF TABLE')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cut-off for the Year Table</h3>
            <div class="card-tools">
            </div>
        </div>

        <div class="card-header">
            @session('success')
                <div class="alert alert-success" role="alert">
                    {{ $value }}
                </div>
            @endsession

            @session('failed')
                <div class="alert alert-danger" role="alert">
                    {{ $value }}
                </div>
            @endsession

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-2 ">
                    <form action="{{ route('attendance.cutoff.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="selectmonth">Month:</label>
                            <select name="monthfilter" id="monthfilter" class="form-control" required>
                                <option value="" selected disabled>select month</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    {{ $monthName = date('F', mktime(0, 0, 0, $month, 1)) }}
                                    <option value="{{ $month }}">
                                        {{ $monthName }} </option>
                                @endfor
                            </select>
                            <x-error>monthfilter</x-error>
                        </div>
                        <button class="btn btn-success"><i class="fa fa-file"></i>Create</button>
                        <a href="{{ route('attendance.cutoffconfig.index') }}" class="btn btn-md btn-info">Show All</a>
                    </form>
                </div>
            </div>
            <div class="row"></div>
            <div class="card-body">
                <table class="table table-striped" id="cutoffTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Month</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Open By</th>
                            <th>Open Date</th>
                            <th>Closed By</th>
                            <th>Closed Date</th>
                            <th>Status</th>
                            <th width="350px;">Action</th>
                            {{-- <th></th>
                        <th></th>
                        <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $cuDet)
                            <tr>
                                <td>{{ $cuDet->id }}</td>
                                <td>{{ $cuDet->Month }}</td>
                                <td>{{ Carbon\Carbon::parse($cuDet->StartDate)->format('m-d-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($cuDet->EndDate)->format('m-d-Y') }}</td>
                                <td>{{ $cuDet->OpenName }}</td>
                                <td>{{ $cuDet->OpenDate }} </td>
                                <td>{{ $cuDet->ClosedName }}</td>
                                <td>{{ $cuDet->ClosedDate }}</td>
                                <td>{{ $cuDet->Status }}</td>
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <form action="{{ route('attendance.cutoffconfig.open', encrypt($cuDet->id)) }}"
                                            method="POST" onsubmit="return confirm('Are sure want to Open this Cut-off?')">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">OPEN</button>
                                        </form>
                                        <form
                                            action="{{ route('attendance.cutoffconfig.close', encrypt($cuDet->id)) }}"
                                            method="POST" onsubmit="return confirm('Are sure want to Close this Cut-off?')">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">CLOSE</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @section('js')
                <script>
                    $(function() {
                        $('#cutoffTable').DataTable({
                            "paging": true,
                            "searching": true,
                            "ordering": true,
                            "responsive": true,
                        });
                    });
                </script>
            @endsection
</x-admin>
