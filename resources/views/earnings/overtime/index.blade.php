<x-admin>
    @section('title','Overtime')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Overtime Table</h3>
            <div class="card-tools">
                <a href="{{ route('earnings.overtime.create') }}" class="btn btn-sm btn-info">New</a>
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
            <table class="table table-striped" id="overtimetypeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Overtime Type Code</th>
                        <th>Description</th>
                        <th>Employee Code</th>
                        <th>Employee</th>
                        <th>Actual IN</th>
                        <th>Actual OUT</th>
                        <th>Filed OT Hours</th>
                        <th>Approved OT Hours</th>
                        <th>Status</th>
                        <th>Prepared By</th>
                        <th>Approved By</th>
                        <th width="250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $otDet)
                        <tr>
                            <td>{{ $otDet->id }}</td>
                            <td>{{ $otDet->OvertimeType }}</td>
                            <td>{{ $otDet->Description }} </td>
                            <td>{{ $otDet->EmployeeCode }} </td>
                            <td>{{ $otDet->EmployeeName }} </td>
                            <td>{{ $otDet->ActualIN }} </td>
                            <td>{{ $otDet->ActualOUT }} </td>
                            <td>{{ number_format($otDet->FiledOTHours,2) }} </td>
                            <td>{{ number_format($otDet->OTHoursApproved,2) }} </td>
                            <td>{{ $otDet->status }}</td>
                            <td>{{ $otDet->CreatedBy }} </td>
                            <td>{{ $otDet->ApprovedBy }} </td>
                            <td>
                                <div style="display:inline-block;margin-right:5px;">
                                <a href="{{ route('earnings.overtime.edit', encrypt($otDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('earnings.overtime.destroy', encrypt($otDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('earnings.overtime.approve', encrypt($otDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to approve?')">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('earnings.overtime.decline', encrypt($otDet->id)) }}" method="POST"
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
                $('#overtimetypeTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
 <script>
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), 1);;
    const FirstDate = today.toLocaleDateString('en-CA'); // 'en-CA' uses the yyyy-mm-dd format
    const LastDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    const EndDate = LastDate.toLocaleDateString('en-CA'); 
    
    // Set the value of the input field
    document.getElementById('start-date').value = FirstDate;
    document.getElementById('end-date').value = EndDate;
    $("#start-date").change(function(){
    $("#end-date").prop("min", $(this).val());
    $("#end-date").val(""); //clear end date input when start date changes
    });
  </script>