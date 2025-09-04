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
                        <th>Approved By</th>
                        <th>Approved Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $lvDet)
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
                            <td>{{ $ltDet->Status }}</td>
                            <td><a href="{{ route('attendance.leave.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('attendance.leave.destroy', encrypt($ltDet->id)) }}" method="POST"
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
