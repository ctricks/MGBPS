<x-admin>
    @section('title','Payroll Processing')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payroll Process Table</h3>
            <div class="card-tools">
                {{-- <a href="{{ route('payroll.payroll.create') }}" class="btn btn-sm btn-info">New</a> --}}
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
            Filter:
            <form action="{{ route('payroll.summarypayroll.list') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="selectmonth">Month:</label>
                            <select name="monthfilter" id="monthfilter" class="form-control" required>
                                <option value="" selected disabled>select month</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    {{ $monthName = date('F', mktime(0, 0, 0, $month, 1)) }}
                                    <option value="{{ $month }}">
                                        {{ $monthName }} </option>
                                @endfor
                            </select>
                            <x-error>civilstatus</x-error>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="civilstatus">Cut-off:</label>
                            <select name="cutoff" id="cutoff" class="form-control" required>
                                <option value="" selected disabled>select cutoff</option>
                                {{-- @foreach ($cutOFF as $cu)
                                    <option value="{{ $cu->id }}"
                                        {{ $cu->id == old('cutoff') ? 'selected' : '' }}>
                                        {{ $cu->StartDate . ' to ' . $cu->EndDate }}</option>
                                @endforeach --}}
                            </select>
                            <x-error>civilstatus</x-error>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="employee">Employee:*</label>
                            <select name="employeecode" id="employeecode" class="form-control">
                                <option value="" selected disabled>select employee</option>
                            </select>
                            <x-error>employeecode</x-error>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="empname">Status:</label>
                            <input type="text" class="form-control" id="payrollprocess" name="payrollprocess"
                                placeholder="Attendance Summary Status" disabled >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="button-container">
                                <button class="btn btn-success"><i class="fa fa-file"></i> Search</button>
                                <a href="{{ route('attendance.summary.index') }}" class="btn btn-md btn-info">Show All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="rawattendanceTable">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Cutoff</th>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Prepared By</th>
                        <th>Prepared Date</th>
                        <th>Approved By</th>
                        <th>Approved Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data != null)
                    @foreach ($data as $empDTR)
                        <tr>
                            <td>{{ $empDTR->Month }}</td>
                            <td>{{ $empDTR->StartDate }} to {{ $empDTR->EndDate}}</td>
                            <td>{{ $empDTR->employee_code }}</td>
                            <td>{{ $empDTR->EmployeeName }}</td>
                            <td>{{ $empDTR->PreparedBy }}</td>
                            <td>{{ $empDTR->PreparedDate }}</td>
                            <td>{{ $empDTR->ApprovedBy }}</td>
                            <td>{{ $empDTR->ApprovedDate }}</td>
                            <td>{{ $empDTR->Status }}</td>
                            <td><a href="{{ route('payroll.summarypayroll.view',['cutoff' => $empDTR->cutoffid, 'empcode' => $empDTR->employee_code]) }}"
                                    class="btn btn-sm btn-primary">View Details</a>
                            </td>
                            {{-- <td width="70px;">
                                <a href="{{ route('attendance.summaryattendance.view',['cutoff' => $empDTR->cutoffid, 'empcode' => $empDTR->employee_code]) }}"
                                    class="btn btn-sm btn-success">Payroll</a>
                            </td>  --}}
                        </tr>
                    @endforeach
                    @endif
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