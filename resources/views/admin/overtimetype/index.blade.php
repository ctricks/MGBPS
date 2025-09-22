<x-admin>
    @section('title','Overtime Type')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Overtime Type Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.overtimetype.create') }}" class="btn btn-sm btn-info">New</a>
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
            <table class="table table-striped" id="overtimetypeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Overtime Type Code</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="50px;">Action</th>
                        <th width="50px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ottDet)
                        <tr>
                            <td>{{ $ottDet->id }}</td>
                            <td>{{ $ottDet->OvertimeType }}</td>
                            <td>{{ $ottDet->Description }} </td>
                            <td>{{ $ottDet->isActive == 1 ? "Active":"In-active"}}</td>
                            <td><a href="{{ route('admin.overtimetype.edit', encrypt($ottDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.overtimetype.destroy', encrypt($ottDet->id)) }}" method="POST"
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
                $('#overtimetypeTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
 <script>
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), 1);;
    const FirstDate = today.toLocaleDateString('en-CA'); // 'en-CA' uses the yyyy-mm-dd format
    const LastDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    const EndDate = LastDate.toLocaleDateString('en-CA'); 
    
    // Set the value of the input field
    document.getElementById('start-date').value = FirstDate;
    document.getElementById('end-date').value = EndDate;
    $("#start-date").change(function(){
    $("#end-date").prop("min", $(this).val());
    $("#end-date").val(""); //clear end date input when start date changes
    });
  </script>