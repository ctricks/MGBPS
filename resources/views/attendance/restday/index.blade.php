<x-admin>
    @section('title','Rest Day')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rest Day Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.restday.create') }}" class="btn btn-sm btn-info">New</a>
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
  
            <form action="{{ route('attendance.restday.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import Data</button>
                    <a href="{{ route('attendance.rawattendance.downloadtemplate') }}" class="btn btn-primary">Download Template</a>
                </div>
            </form>    
        </div>
        <div class="card-body">
            <table class="table table-striped" id="restdayTable">
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Employee</th>
                        <th>Rest Day</th>
                        <th>Active</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $empDet)
                        <tr>
                            <td>{{ $empDet->employeenumber }}</td>
                            <td>{{ $empDet->lastname . ',' . $empDet->firstname }}</td>
                            <td>{{ $empDet->restday }}</td>
                            <td>{{ $empDet->isActive == 1 ? "Active":"In-active" }}</td>
                            <td><a href="{{ route('attendance.restday.edit', encrypt($empDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('attendance.restday.destroy', encrypt($empDet->id)) }}" method="POST"
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
                $('#restdayTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
