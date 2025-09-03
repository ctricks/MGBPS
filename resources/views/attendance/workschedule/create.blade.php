<x-admin>
    @section('title', 'Create Work Schedule')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Work Schedule</h3>
            <div class="card-tools"><a href="{{ route('attendance.workschedule.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('attendance.workschedule.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="empnumber" class="form-label">Schedule Name:*</label>
                            <input type="text" class="form-control" id="KeySchedule" name="KeySchedule"
                                placeholder="Enter Schedule Name" required >
                                <x-error>KeySchedule</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Start Time:*</label>
                            <input type="time" class="form-control" id="starttime" name="starttime"
                                placeholder="Enter Start Time" required >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">End Time:*</label>
                            <input type="time" class="form-control" id="endtime" name="endtime"
                                placeholder="Enter End Time" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="lblGracePerios" class="form-label">Grace Period:*</label>
                            <input type="number" class="form-control" id="GracePeriod" name="GracePeriod"
                                placeholder="Enter Grace Period" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="isActive" class="form-label">Active:*</label>
                            <select name="isActive" id="isActive" class="form-control" required>
                                <option value="" selected disabled>Select Record Status</option>
                                <option value="1" selected>Active</option>
                                <option value="0">In-active</option>
                            </select>
                            <x-error>isActive</x-error>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin>
<!-- Script -->
<script>
    $(document).ready(function(){
        // EmployeeCode Change
        $('#empcode').change(function(){
             // Employee id
             var id = $(this).val();
             
             // AJAX request 
             $.ajax({
                 url: '/get-employee/'+id,
                 type: 'get',
                 dataType: 'json',
                 success: function(response){
                     var len = 0;
                     if(response[0].lastname != null){
                          len = response[0].lastname.length;
                     }
                     if(len > 0){
                       document.getElementById("lastname").value = response[0].lastname;
                       document.getElementById("firstname").value = response[0].firstname;
                       document.getElementById("middlename").value = response[0].middlename;
                     }

                 }
             });
        });
    });
    </script>