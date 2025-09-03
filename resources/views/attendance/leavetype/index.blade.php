<x-admin>
    @section('title','Leave Type')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Leave Type Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.leavetype.create') }}" class="btn btn-sm btn-info">New</a>
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
            <table class="table table-striped" id="leavetypeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Leave Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ltDet)
                        <tr>
                            <td>{{ $ltDet->id }}</td>
                            <td>{{ $ltDet->LeaveType }}</td>
                            <td>{{ $ltDet->Description }}</td>
                            <td>{{ $ltDet->isActive == 1 ? "Active":"In-active" }}</td>
                            <td><a href="{{ route('attendance.leavetype.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('attendance.leavetype.destroy', encrypt($ltDet->id)) }}" method="POST"
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
                $('#leavetypeTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
