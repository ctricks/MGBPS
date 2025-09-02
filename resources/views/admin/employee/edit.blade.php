<x-admin>
    @section('title', 'Edit Employee')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Employee</h3>
            <div class="card-tools"><a href="{{ route('admin.employee.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.employee.update',$employee) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $employee->id }}">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Number:*</label>
                                <input type="text" class="form-control" name="employeenumber" required numeric
                                    value="{{ $employee->employeenumber }}">
                                    <x-error>employeenumber</x-error>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                    <label for="lastname" class="form-label">Lastname:*</label>
                                    <input type="text" class="form-control" name="lastname" required
                                        value="{{ $employee->lastname }}">
                                        <x-error>lastname</x-error>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="firstname" class="form-label">Firstname:*</label>
                                <input type="text" class="form-control" name="firstname" required
                                    value="{{ $employee->firstname }}">
                                <x-error>lastname</x-error>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="middlename" class="form-label">Middlename:</label>
                                <input type="text" class="form-control" name="middlename"
                                    value="{{ $employee->middlename }}">
                                <x-error>middlename</x-error>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ $employee->Address }}">
                                <x-error>address</x-error>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone" class="form-label">Contact Number:</label>
                                <input type="text" class="form-control" name="telephone" 
                                    value="{{ $employee->Telephone }}">
                                <x-error>telephone</x-error>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                    <label for="birthdDate">Birthday:</label>
                                    <input id="birthday" class="form-control" name="birthday" type="date" value="{{ $empBirthDate}}" />
                                <x-error>birthday</x-error>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="civilstatus">Civil Status:</label>
                                <select name="civilstatus" id="civilstatus" class="form-control" required>
                                    <option value="" selected disabled>select civil status</option>
                                    @foreach ($civilstatus as $cv)
                                        <option value="{{ $cv->id }}"
                                            {{ $cv->id == $employee->civil_status_id ? 'selected' : '' }}>{{ $cv->civilstatus }}</option>
                                    @endforeach
                                </select>
                                <x-error>civilstatus</x-error>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="" selected disabled>select gender</option>
                                    @foreach ($gender as $g)
                                        <option value="{{ $g->id }}"
                                            {{ $g->id == $employee->gender_id ? 'selected' : '' }}>{{ $g->gender }}</option>
                                    @endforeach
                                </select>
                                <x-error>gender</x-error>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="position">Position:</label>
                                <select name="position" id="position" class="form-control" required>
                                    <option value="" selected disabled>select position</option>
                                    @foreach ($position as $p)
                                        <option value="{{ $p->id }}"
                                            {{ $p->id == $employee->position_id ? 'selected' : '' }}>{{ $p->PositionName }}</option>
                                    @endforeach
                                </select>
                                <x-error>position</x-error>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="department">Department:</label>
                                <select name="departmentname" id="departmentname" class="form-control" required>
                                    <option value="" selected disabled>select deparment</option>
                                    @foreach ($department as $d)
                                        <option value="{{ $d->id }}"
                                            {{ $d->id == $employee->department_id ? 'selected' : '' }}>{{ $d->departmentname }}</option>
                                    @endforeach
                                </select>
                                <x-error>department</x-error>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="employeestatus">Employee Status:</label>
                                <select name="employeestatus" id="employeestatus" class="form-control" required>
                                    <option value="" selected disabled>select employee status</option>
                                    @foreach ($employeestatus as $es)
                                        <option value="{{ $es->id }}"
                                            {{ $es->id == $employee->employee_status_id ? 'selected' : '' }}>{{ $es->employeestatus }}</option>
                                    @endforeach
                                </select>
                                <x-error>employeestatus</x-error>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="employeestatus">Work Schedule:</label>
                                <select name="workschedule" id="workchedule" class="form-control" required>
                                    <option value="" selected disabled>select work schedule</option>
                                    @foreach ($workschedule as $ws)
                                        <option value="{{ $ws->id }}"
                                            {{ $ws->id == $employee->WorkDays ? 'selected' : '' }}>{{ $ws->KeySchedule }} ({{ date('h:i A',strtotime($ws->StartTime)) }} to {{ date('h:i A',strtotime($ws->EndTime)) }})</option>
                                    @endforeach
                                </select>
                                <x-error>employeestatus</x-error>
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
