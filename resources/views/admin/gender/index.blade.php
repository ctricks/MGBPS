<x-admin>
    @section('title', 'Gender')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Gender Table</h3>
            <div class="card-tools"><a href="{{ route('admin.gender.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="genderTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gender</th>
                        <th>Is Active</th>
                        <th>Created</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $gender)
                        <tr>
                            <td>{{ $gender->id }}</td>
                            <td>{{ $gender->gender }}</td>
                            <td>{{ $gender->isActive == 1 ? "Active":"In-active"}}</td>
                            <td>{{ $gender->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.gender.edit', encrypt($gender->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.gender.destroy', encrypt($gender->id)) }}" method="POST"
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
                $('#genderTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
