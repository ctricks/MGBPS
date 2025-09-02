<x-admin>
    @section('title', 'Raw Attendance')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Raw Attendance Table</h3>
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
                    <a href="{{ route('attendance.rawattendance.downloadtemplate') }}" class="btn btn-primary">Download
                        Template</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            Filter:
            <form action="{{ route('attendance.rawattendance.list') }}" method="POST">
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
                            <select name="employeecode" id="employeecode" class="form-control" required>
                                <option value="" selected disabled>select employee</option>
                            </select>
                            <x-error>employeecode</x-error>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="empname">Status:</label>
                            <input type="text" class="form-control" id="payrollprocess" name="payrollprocess"
                                placeholder="" disabled value={{ $ProcessStatus }}>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="button-container">
                                <button class="btn btn-success"><i class="fa fa-file"></i> Search</button>
                                <a href="{{ route('attendance.raw.index') }}" class="btn btn-md btn-info">Show All</a>
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
                        <th>ID</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>EmployeeCode</th>
                        <th>In_1</th>
                        <th>Out_1</th>
                        <th>In_2</th>
                        <th>Out_2</th>
                        <th>In_3</th>
                        <th>Out_3</th>
                        <th>Fin In</th>
                        <th>Fin Out</th>
                        <th>W Hrs</th>
                        <th>ND</th>
                        {{-- <th>ND8 Hours</th> --}}
                        <th>OT</th>
                        {{-- <th>OT8 Hours</th> --}}
                        <th>Absent</th>
                        <th>Late</th>
                        <th>Utime</th>
                        <th>Action</th>
                        <th></th>
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
                            <td>{{ $empDTR->Final_IN }}</td>
                            <td>{{ $empDTR->Final_OUT }}</td>
                            <td>{{ $empDTR->WorkingHours }}</td>
                            <td>{{ $empDTR->NDHours }}</td>
                            <td>{{ $empDTR->OTHours }}</td>
                            <td>{{ $empDTR->Absent }}</td>
                            <td>{{ $empDTR->Late }}</td>
                            <td>{{ $empDTR->Undertime }}</td>
                            {{-- <td>{{ $empDTR->WorkingHours }}</td>
                            <td>{{ $empDTR->WorkingHours }}</td> --}}
                            
                            <td><div style = "flex; justify-content: center; gap: 1px;">
                                <a href="{{ route('attendance.raw.edit', encrypt($empDTR->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                </div>
                            </td>
                            <td>
                                <div>
                                <form action="{{ route('attendance.raw.index', encrypt($empDTR->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                            </td>
                            {{-- <td>
                                
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
            <script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#monthfilter').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-cutoff/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    $('#cutoff').find('option').remove().end();
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
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-dtr-employee/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response[0].employee_code != null) {
                                    len = response[0].employee_code.length;
                                }
                                if (len > 0) {
                                    const selectElement = document.getElementById('employeecode');
                                    $('#employeecode').find('option').remove().end();
                                    // Loop through the data and create <option> elements
                                    response.forEach(response => {
                                        const option = document.createElement('option');
                                        option.value = response
                                        .employee_code; // Set the value attribute
                                        option.textContent = response
                                        .employee_code; // Set the display text
                                        selectElement.appendChild(
                                        option); // Append the option to the select
                                    });
                                }

                            }
                        });
                    });
                });
            </script>
        @endsection
</x-admin>
