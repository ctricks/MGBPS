<x-admin>
    @section('title', 'Create Employee')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">To create an employee record, please complete all required fields.</h3>
            <div class="card-tools"><a href="{{ route('admin.employee.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.employee.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group col-lg-4">
                            <label for="employeenumber" class="form-label">Employee Number:*</label>
                            <input type="text" class="form-control" name="employeenumber" required numeric
                                value="{{ old('employeenumber') }}">
                                <x-error>employeenumber</x-error>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <label for="lastname" class="form-label">Lastname:*</label>
                                <input type="text" class="form-control" name="lastname" required
                                    value="{{ old('lastname') }}">
                                    <x-error>lastname</x-error>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="firstname" class="form-label">Firstname:*</label>
                            <input type="text" class="form-control" name="firstname" required
                                value="{{ old('firstname') }}">
                            <x-error>lastname</x-error>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="middlename" class="form-label">Middlename:</label>
                            <input type="text" class="form-control" name="middlename"
                                value="{{ old('lastname') }}">
                            <x-error>middlename</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" name="address"
                                value="{{ old('address') }}">
                            <x-error>address</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                             <label for="telephone" class="form-label">Contact Number:</label>
                            <input type="text" class="form-control" name="telephone" 
                                value="{{ old('telephone') }}">
                            <x-error>telephone</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                                <label for="birthdDate">Birthday:</label>
                                <input id="birthday" class="form-control" type="date" />
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
                                        {{ $cv->civilstatus == old('civilstatus') ? 'selected' : '' }}>{{ $cv->civilstatus }}</option>
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
                                        {{ $g->gender == old('gender') ? 'selected' : '' }}>{{ $g->gender }}</option>
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
                                        {{ $p->PositionName == old('position') ? 'selected' : '' }}>{{ $p->PositionName }}</option>
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
                                        {{ $d->departmentname == old('departmentname') ? 'selected' : '' }}>{{ $d->departmentname }}</option>
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
                                        {{ $es->employeestatus == old('employeestatus') ? 'selected' : '' }}>{{ $es->employeestatus }}</option>
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
