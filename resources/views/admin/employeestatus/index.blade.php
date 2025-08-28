<x-admin>
    @section('title', 'Employee Status')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee Status Table</h3>
            <div class="card-tools"><a href="{{ route('admin.employeestatus.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="employeestatusTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee Status</th>
                        <th>Is Active</th>
                        <th>Created</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $es)
                        <tr>
                            <td>{{ $es->id }}</td>
                            <td>{{ $es->employeestatus }}</td>
                            <td>{{ $es->isActive == 1 ? "Active":"In-active"}}</td>
                            <td>{{ $es->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.employeestatus.edit', encrypt($es->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.employeestatus.destroy', encrypt($es->id)) }}" method="POST"
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
                $('#employeestatusTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
