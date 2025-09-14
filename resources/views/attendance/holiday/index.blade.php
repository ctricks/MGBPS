<x-admin>
    @section('title','Holiday Management')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Holiday Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.holiday.create') }}" class="btn btn-sm btn-info">New</a>
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
            <form action="{{ route('attendance.holiday.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
                    <a href="{{ route('attendance.holiday.downloadtemplate') }}" class="btn btn-primary">Download Template</a>
                </div>
                
                
            </form>    
        </div>
        <div class="card-body">
            <table class="table table-striped" id="HolidayTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Holiday</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>isActive</th>
                        <th>Updated Date</th>
                        <th>Updated By</th>
                        <th>Created Date</th>
                        <th>Created By</th>
                        <th width = "250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $hDet)
                        <tr>
                            <td>{{ $hDet->id }}</td>
                            <td>{{ $hDet->Year}}</td>
                            <td>{{ $hDet->HolidayName }}</td>
                            <td>{{ $hDet->Date }}</td>
                            <td>{{ $hDet->HolidayType }}</td>
                            <td>{{ $hDet->isActive }}</td>
                            <td>{{ $hDet->CreatedBy }}</td>
                            <td>{{ $hDet->CreatedDate }}</td>
                            <td>{{ $hDet->UpdatedBy }}</td>
                            <td>{{ $ltDet->UpdatedDate }}</td>
                            <td><div style="display:inline-block;margin-right:5px;"><a href="{{ route('attendance.leave.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('attendance.leave.destroy', encrypt($hDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
