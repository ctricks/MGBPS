<x-admin>
    @section('title', 'Civil Status')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Civil Status Table</h3>
            <div class="card-tools"><a href="{{ route('admin.civilstatus.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="civilstatusTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Civil Status</th>
                        <th>Is Active</th>
                        <th>Created</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $civilstatus)
                        <tr>
                            <td>{{ $civilstatus->id }}</td>
                            <td>{{ $civilstatus->civilstatus }}</td>
                            <td>{{ $civilstatus->isActive == 1 ? "Active":"In-active"}}</td>
                            <td>{{ $civilstatus->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.civilstatus.edit', encrypt($civilstatus->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.civilstatus.destroy', encrypt($civilstatus->id)) }}" method="POST"
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
                $('#civilstatusTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
