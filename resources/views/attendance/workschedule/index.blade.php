<x-admin>
    @section('title','Work Schedule')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Work Schedule Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.workschedule.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>

    <div class="card-header">
  
            @session('success')
                <div class="alert alert-success" role="alert"> 
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
            <table class="table table-striped" id="workscheduleTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Schedule</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Grace Period (Minutes)</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $wsDet)
                        <tr>
                            <td>{{ $wsDet->id }}</td>
                            <td>{{ $wsDet->KeySchedule }}</td>
                            <td>{{ Carbon\Carbon::parse($wsDet->StartTime)->format('H:i A') }}</td>
                            <td>{{ Carbon\Carbon::parse($wsDet->EndTime)->format('H:i A') }}</td>
                            <td>{{ $wsDet->GracePeriodMins }}</td>
                            <td>{{ $wsDet->isActive == 1 ? "Active":"In-active" }}</td>
                            <td><a href="{{ route('attendance.workschedule.edit', encrypt($wsDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('attendance.workschedule.destroy', encrypt($wsDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @section('js')
        <script>
            $(function() {
                $('#workscheduleTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
