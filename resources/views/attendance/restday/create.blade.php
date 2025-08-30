<x-admin>
    @section('title', 'Create Restday')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Restday</h3>
            <div class="card-tools"><a href="{{ route('attendance.restday.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('attendance.restday.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="empnumber" class="form-label">Employee Code:*</label>
                            <select name="empcode" id="empcode" class="form-control" required>
                                 <option value="" selected disabled>Select Employee Code</option>
                                @foreach($data as $emp)
                                    <option value='{{ $emp->id }}'>({{ $emp->employeenumber }}) - {{$emp->lastname}},{{$emp->firstname}} {{$emp->middlename}}</option>
                                @endforeach
                            </select>
                                <x-error>employeenumber</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                placeholder="Enter Lastname" required disabled >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="Enter Firstname" required disabled >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Middlename</label>
                            <input type="text" class="form-control" id="middlename" name="middlename"
                                placeholder="Enter Firstname" required disabled >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lblRestday" class="form-label">Restday:*</label>
                            <select name="Restday" id="Restday" class="form-control" required>
                                <option value="" selected disabled>Select Rest Day</option>
                                <option value="Sunday" selected>Sunday</option>
                                <option value="Monday" selected>Monday</option>
                                <option value="Tuesday" selected>Tuesday</option>
                                <option value="Wednesday" selected>Wednesday</option>
                                <option value="Thursday" selected>Thursday</option>
                                <option value="Friday" selected>Friday</option>
                                <option value="Saturday" selected>Saturday</option>
                            </select>
                            <x-error>Restday</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lblRemarks" class="form-label">Remarks:</label>
                            <input type="text" class="form-control" id="Remarks" name="Remarks"
                                placeholder="Enter Remarks" multiline>
                            <x-error>Remarks</x-error>
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

        // Department Change
        $('#empcode').change(function(){
             // Department id
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