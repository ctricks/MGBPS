<x-admin>
    @section('title','View Attendance Summary')
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Final Attendance Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.summary.index') }}" class="btn btn-sm btn-info">Back</a>
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
            <table class="table table-striped" id="rawattendanceTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>EmpCode</th>
                        <th>In_1</th>
                        <th>Out_1</th>
                        <th>In_2</th>
                        <th>Out_2</th>
                        <th>In_3</th>
                        <th>Out_3</th>
                        <th>DType</th>
                        <th>F.In</th>
                        <th>F.Out</th>
                        <th>Work</th>
                        <th>ND</th>
                        {{-- <th>ND8 Hours</th> --}}
                        <th>OT</th>
                        <th>Leave</th>
                        <th>Abs</th>
                        <th>Late</th>
                        <th>Utime</th>
                        {{-- <th>Action</th> --}}
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $empDTR)
                        <tr>
                            <td>{{ $empDTR->id }}</td>
                            <td>{{ $empDTR->date }}</td>
                            <td>{{ $empDTR->Day }}</td>
                            <td>{{ $empDTR->employee_code }}</td>
                            <td>{{ $empDTR->TimeIN }}</td>
                            <td>{{ $empDTR->TimeOUT }}</td>
                            <td>{{ $empDTR->TimeIN_2 }}</td>
                            <td>{{ $empDTR->TimeOUT_2 }}</td>
                            <td>{{ $empDTR->TimeIN_3 }}</td>
                            <td>{{ $empDTR->TimeOUT_3 }}</td>
                            <td>{{ $empDTR->RestDay }}</td>
                            <td>{{ $empDTR->Final_IN }}</td>
                            <td>{{ $empDTR->Final_OUT }}</td>
                            @if($empDTR->WorkingHours < 8)
                                <td style="color:red;">{{ number_format($empDTR->WorkingHours,2) }}</td>
                            @else
                                <td>{{ number_format($empDTR->WorkingHours,2) }}</td>
                            @endif                  
                            <td>{{ number_format($empDTR->NDHours,2) }}</td>
                            <td>{{ number_format($empDTR->OTHours,2) }}</td>
                            <td>{{ number_format($empDTR->Leave,2) }}</td>
                            @if($empDTR->Absent == 8)
                                <td style="color:red;">{{ $empDTR->Absent }}</td>
                            @else
                                <td>{{ $empDTR->Absent }}</td>
                            @endif
                            @if($empDTR->Late > 0)
                                <td style="color:red;">{{ number_format($empDTR->Late,2) }}</td>
                            @else
                                <td>{{ number_format($empDTR->Late,2) }}</td>
                            @endif
                            @if($empDTR->Undertime > 0)
                                <td style="color:red;">{{ number_format($empDTR->Undertime,2) }}</td>
                            @else
                                <td>{{ number_format($empDTR->Undertime,2) }}</td>
                            @endif
                            {{-- <td>{{ $empDTR->WorkingHours }}</td>
                            <td>{{ $empDTR->WorkingHours }}</td> --}}
                            {{--
                            <td><div style = "flex; justify-content: center; gap: 1px;">
                                <a href="{{ route('attendance.raw.edit', encrypt($empDTR->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                </div>
                            </td>
                             <td>
                                <div>
                                <form action="{{ route('attendance.raw.destroy', encrypt($empDTR->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                            </td> --}}
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
                    pageLength: 15,
                });
            });
        </script>
    @endsection
</x-admin>
<script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#monthfilter').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#cutoff').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-cutoff/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.StartDate +
                                            ' to ' + response.EndDate, response.id);
                                        // Append the new option to the dropdown
                                        $('#cutoff').append(newOption);
                                    });
                                }
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#cutoff').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#employeecode').find('option').remove().end();
                       
                        if(id > 0)
                        {
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-dtr-employee/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.employee_code, response.id);
                                        // Append the new option to the dropdown
                                        $('#employeecode').append(newOption);
                                    });
                                }

                            }
                        });
                        }
                    });
                });
            </script>