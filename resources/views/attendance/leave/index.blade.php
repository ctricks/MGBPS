<x-admin>
    @section('title','Leave Management')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Leave Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.leave.create') }}" class="btn btn-sm btn-info">New</a>
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
            <table class="table table-striped" id="leaveTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Leave</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Approved/Decline Date</th>
                        <th>Approved/Decline By</th>
                        <th>Status</th>
                        <th width = "250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ltDet)
                        <tr>
                            <td>{{ $ltDet->id }}</td>
                            <td>{{ $ltDet->EmpCode}}</td>
                            <td>{{ $ltDet->EmployeeName }}</td>
                            <td>{{ $ltDet->LeaveType }}</td>
                            <td>{{ $ltDet->Description }}</td>
                            <td>{{ $ltDet->StartDate }}</td>
                            <td>{{ $ltDet->EndDate }}</td>
                            <td>{{ $ltDet->ApprovedDate }}</td>
                            <td>{{ $ltDet->ApprovedBy }}</td>
                            @if($ltDet->Status == "Declined")
                                <td style="color:red;">{{ $ltDet->Status }}</td>
                            @else
                                <td>{{ $ltDet->Status }}</td>
                            @endif
                            {{-- <td>{{ $ltDet->Status }}</td> --}}
                            <td><div style="display:inline-block;margin-right:5px;"><a href="{{ route('attendance.leave.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('attendance.leave.destroy', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('attendance.leave.approve', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to approve?')">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('attendance.leave.decline', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to Decline?')">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning">Decline</button>
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
                $('#leaveTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
