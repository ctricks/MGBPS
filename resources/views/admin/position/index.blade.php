<x-admin>
    @section('title', 'Position')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Position Table</h3>
            <div class="card-tools"><a href="{{ route('admin.position.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="positionTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Position</th>
                        <th>Is Active</th>
                        <th>Created</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $position)
                        <tr>
                            <td>{{ $position->id }}</td>
                            <td>{{ $position->PositionName }}</td>
                            <td>{{ $position->isActive == 1 ? "Active":"In-active"}}</td>
                            <td>{{ $position->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.position.edit', encrypt($position->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.position.destroy', encrypt($position->id)) }}" method="POST"
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
                $('#positionTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
