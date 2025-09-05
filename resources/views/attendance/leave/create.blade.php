<x-admin>
    @section('title', 'Create Leave')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Leave</h3>
            <div class="card-tools"><a href="{{ route('attendance.leavetype.index') }}" class="btn btn-sm btn-dark">Back</a></div>
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
            <form action="{{ route('attendance.leave.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="lblleavetype" class="form-label">Applied For:*</label>
                            <select name="leavetype" id="leavetype" class="form-control" required>
                                <option value="" selected disabled>Select a Leave Type</option>
                                @foreach ($LeaveType as $lt)
                                    <option value="{{ $lt->id }}">{{ $lt->LeaveType }} ( {{ $lt->Description }} )</option>                                
                                @endforeach
                            </select>
                            <x-error>leavetype</x-error>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="employeecode" class="form-label">Employee Code:*</label>
                             <select name="empcode" id="empcode" class="form-control" required>
                                <option value="" selected disabled>Select Employee Code</option>
                                @foreach ($employee as $emp)
                                    <option value="{{ $emp->id }}">({{ $emp->employeenumber }}) - {{ $emp->lastname.','.$emp->firstname.' '.$emp->middlename }} </option>                                
                                @endforeach
                            </select>    
                            <x-error>employeecode</x-error>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="form-group">
                            <label for="name">Firstname:</label>
                            <input type="string" class="form-control" id="firstname" name="firstname"
                                placeholder="Enter Firstname" disabled>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="name">Middlename:*</label>
                            <input type="string" class="form-control" id="middlename" name="middlename"
                                placeholder="Enter Middlename" disabled >
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="name">Lastname:*</label>
                            <input type="string" class="form-control" id="lastname" name="lastname"
                                placeholder="Enter Lastname" disabled >
                        </div>
                    </div> --}}
                    
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="name">Description:*</label>
                            <input type="string" class="form-control" id="description" name="description"
                                placeholder="Enter Description" required >
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="name">Start Date:*</label>
                            <input type="date" class="form-control" id="StartDate" name="StartDate"
                                placeholder="Enter Date" required >
                            <x-error>StartDate</x-error>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="name">End Date:*</label>
                            <input type="date" class="form-control" id="EndDate" name="EndDate"
                                placeholder="Enter Date" required >
                                <x-error>EndDate</x-error>
                        </div>
                    </div>
                    <div class="col-lg-3">
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
