<x-admin>
    @section('title', 'Edit Overtime')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Overtimes</h3>
                        <div class="card-tools">
                            <a href="{{ route('earnings.overtime.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('earnings.overtime.update', $data) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="empnumber" class="form-label">Overtime Type:*</label>
                                        <select name="OvertimeType" id="OvertimeType" class="form-control" required>
                                            <option value="">select overtime type</option>
                                            @foreach ($OvertimeType as $lt)
                                                <option value="{{ $lt->Description }}"
                                                    {{ $lt->id == $data->OverTimeTypeID ? 'selected' : '' }}>
                                                    {{ $lt->OvertimeType }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-error>overtimetype</x-error>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="LoanType" class="form-label">Description:*</label>
                                        <input class="form-control" id="overtime" name="overtime" type="text" value="{{ $overtimetypedesc }}"
                                            readonly>
                                        <x-error>overtime</x-error>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Select Date:</label>
                                        <input type="date" id="date" name="date" class="form-control"
                                            placeholder="YYYY-MM-DD" value={{ $data->OTDate }} required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="name">Employee Code:*</label>
                                        <input class="form-control" id="empcode" name="empcode" type="text" value="{{ $data->EmployeeCode }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="Employee" class="form-label">Employee:*</label>
                                        <select name="Employee" id="Employee" class="form-control" required>
                                            <option value="" selected >Select Employee</option>
                                            @foreach ($employee as $emp)
                                                <option value="{{ $emp->employeenumber }}"
                                                    {{ $emp->employeenumber == $data->EmployeeCode ? 'selected' : '' }}>
                                                    {{ $emp->lastname }} , {{ $emp->firstname }} {{ $emp->middlename }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-error>Employee</x-error>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Actual IN:</label>
                                        <input type="text" id="TimeIN" name="TimeIN" class="form-control"
                                            placeholder="00:00" value="{{ \Carbon\Carbon::parse($data->ActualIN)->format('h:i A') }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Actual OUT:</label>
                                        <input type="text" id="TimeOUT" name="TimeOUT" class="form-control"
                                            placeholder="00:00" value="{{ \Carbon\Carbon::parse($data->ActualOUT)->format('h:i A') }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Schedule OUT:</label>
                                        <input type="text" id="SchedOut" name="SchedOut" class="form-control"
                                            placeholder="00:00" value="{{ \Carbon\Carbon::parse($data->EndTime)->format('h:i A') }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Actual OT Hours:</label>
                                        <input type="text" id="ActualOTHours" name="ActualOTHours"
                                            class="form-control" placeholder="0.00" value="{{ $data->ActualOTHours }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Apply OT Hours:</label>
                                        <input type="text" id="FiledOTHours" name="FiledOTHours" class="form-control"
                                            placeholder="0.00" value="{{ $data->FiledOTHours }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
<script>
    $(document).ready(function() {
        // Cutoff Change
        $('#OvertimeType').change(function() {
            // Cutoff id
            var lt = $(this).val();
            console.log(lt);
            const description = document.getElementById("overtime");
            description.value = lt;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#Employee').change(function() 
        {
           var empCode = $(this).val(); 
           CheckOvertime(empCode);
        });
        $('#date').change(function() 
        {
           empCode = document.getElementById("empcode").value;
           CheckOvertime(empCode);
           console.log(empCode);
        });
        const CheckOvertime = (empCode) =>{
            // var empCode = document.getElementById("empcode").value;
            document.getElementById("empcode").value = empCode;
            var DateOT = document.getElementById("date").value;
            $.ajax({
                url: '/getemployeeovertime/' + empCode + '/' + DateOT, // Replace with your server URL
                type: 'GET',
                data: {},
                success: function(response) {
                    console.log(response[0].employeenumber);
                    const ActualIN = document.getElementById("TimeIN");
                    ActualIN.value = response[0].FinalIN;
                    const ActualOUT = document.getElementById("TimeOUT");
                    ActualOUT.value = response[0].FinalOUT;
                    const ScheduleOUT = document.getElementById("SchedOut");
                    ScheduleOUT.value = response[0].EndTime;
                    const ActualOTOUT = document.getElementById("ActualOTHours");
                    ActualOTOUT.value = response[0].ActualOT;

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
</script>