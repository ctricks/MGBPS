<x-admin>
    @section('title', 'Department')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Department Table</h3>
            <div class="card-tools"><a href="{{ route('admin.department.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="departmentTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Description</th>
                        <th>Is Active</th>
                        <th>Created</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->departmentname }}</td>
                            <td>{{ $department->Description }}</td>
                            <td>{{ $department->isActive == 1 ? "Active":"In-active"}}</td>
                            <td>{{ $department->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.department.edit', encrypt($department->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.department.destroy', encrypt($department->id)) }}" method="POST"
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
                $('#departmentTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
