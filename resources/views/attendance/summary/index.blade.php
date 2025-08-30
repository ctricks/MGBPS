<x-admin>
    @section('title','Attendance Inquiry')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Final Attendance Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.raw.create') }}" class="btn btn-sm btn-info">New</a>
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
  
            <form action="{{ route('attendance.rawattendance.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
                    <a href="{{ route('attendance.rawattendance.downloadtemplate') }}" class="btn btn-primary">Download Template</a>
                </div>
                
                
            </form>    
        </div>
        <div class="card-body">
            <table class="table table-striped" id="rawattendanceTable">
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Name</th>
                        <th>In_1</th>
                        <th>Out_1</th>
                        <th>In_2</th>
                        <th>Out_2</th>
                        <th>In_3</th>
                        <th>Out_3</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $empDTR)
                        <tr>
                            <td>{{ $empDTR->employee_code }}</td>
                            <td>{{ $empDTR->date }}</td>
                            <td>{{ $empDTR->day }}</td>
                            <td>{{ $empDTR->Employee }}</td>
                            <td>{{ $empDTR->in_1 }}</td>
                            <td>{{ $empDTR->out_1 }}</td>
                            <td>{{ $empDTR->in_2 }}</td>
                            <td>{{ $empDTR->out_2 }}</td>
                            <td>{{ $empDTR->in_3 }}</td>
                            <td>{{ $empDTR->out_3 }}</td>
                            <td><a href="{{ route('admin.category.edit', encrypt($empDTR->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.category.destroy', encrypt($empDTR->id)) }}" method="POST"
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
                $('#rawattendanceTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
