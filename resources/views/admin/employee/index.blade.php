<x-admin>
    @section('title', 'Employees')
    {{-- <div id="details-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="details-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="{{ route('admin.employee.import') }}" method="POST"
                                    onsubmit="return confirm('Are sure want to upload?')">
                <div class="modal-header">
                    <h4 class="modal-title">Select Upload File</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Filename: </label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>
                    <div class="card-tools"><button type="submit">Upload</button></div>
            </form>
            </div>
        </div>
    </div> --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee Table</h3>
            <div class="card-tools"><a href="{{ route('admin.employee.create') }}" class="btn btn-sm btn-primary">Add</a></div>
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
  
            <form action="{{ route('admin.employee.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
                    <a href="{{ route('admin.employee.downloadtemplate') }}" class="btn btn-primary">Download Template</a>
                </div>
                
                
            </form>    
        </div>

        <div class="card-body">
            <table class="table table-striped" id="employeeTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee Number</th>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->employeenumber }}</td>
                            <td>{{ $employee->lastname }}</td>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->middlename }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>
                                <a href="{{ route('admin.employee.edit', encrypt($employee->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.employee.destroy', encrypt($employee->id)) }}" method="POST"
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
    </div>
    @section('js')
        <script>
            $(function() {
                $('#employeeTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
