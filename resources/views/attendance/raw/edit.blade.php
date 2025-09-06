<x-admin>
    @section('title','Edit Raw Attendance')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Raw Attendance</h3>
                        <div class="card-tools">
                            <a href="{{ route('attendance.raw.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('attendance.raw.update',$data) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">Date:</label>
                                    <input type="date" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter Date" disabled value = {{ $data->date }}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Employee Code:</label>
                                <input type="text" class="form-control" id="empcode" name="empcode"
                                    placeholder="Enter employee code" read-only required value="{{ $data->employee_code }}">
                            </div>
                            <x-error>empcode</x-error>
                            <div class="display:inline-block;col-lg-4">
                                <div class="form-group">
                                    <label for="last">Lastname:</label>
                                    <input type="string" class="form-control" id="lastname" name="lastname"
                                        placeholder="Enter Lastname" disabled value = {{ $employee->lastname }}>
                                </div>
                                <div class="form-group">
                                    <label for="first">Firstname:</label>
                                    <input type="string" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter Firstname" disabled  value = {{ $employee->firstname }}>
                                </div>
                                <div class="form-group">
                                    <label for="middle">Middlename:</label>
                                    <input type="string" class="form-control" id="middle" name="middlename"
                                        placeholder="Enter Firstname" disabled  value = {{ $employee->middlename }}>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <table>
                                    <th><div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            @if($data->in_1 == '' or $data->in_1 == null)
                                            <input 
                                                type="time"  
                                                id="time_in" name="time_in" value="">
                                            @else
                                            <input 
                                                type="time" 
                                                id="time_in" name="time_in"
                                                value="{{ (date('H:i', strtotime($data->in_1))) }}" 
                                                class="time-input-style"
                                            >
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="name">TimeOut:</label>
                                            @if($data->out_1 == '' or $data->out_1 == null)
                                            <input 
                                                type="time"  name="time_out"
                                                id="time_out" value="">
                                            @else
                                            <input 
                                                type="time" 
                                                id="time_out" name="time_out"
                                                value="{{ (date('H:i', strtotime($data->out_1))) }}" 
                                                class="time-input-style"
                                            >
                                            @endif
                                        </div>
                                    </th>
                                    <th>&nbsp;
                                    </th>
                                    <th><div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            @if($data->in_2 == '' or $data->in_2 == null)
                                            <input 
                                                type="time"  name="time_in2"
                                                id="time_in2" value="">
                                            @else
                                            <input 
                                                type="time" 
                                                id="time_in2" name="time_in2"
                                                value="{{ (date('H:i', strtotime($data->in_2))) }}" 
                                                class="time-input-style"
                                            >
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="name">TimeOut:</label>
                                            @if($data->out_2 == '' or $data->out_2 == null)
                                            <input 
                                                type="time"  name="time_out2"
                                                id="time_out2" value="">
                                            @else
                                            <input 
                                                type="time" 
                                                id="time_out2" name="time_out2"
                                                value="{{ (date('H:i', strtotime($data->out_2))) }}" 
                                                class="time-input-style"
                                            >
                                            @endif
                                        </div>
                                    </th>
                                    <th>&nbsp;
                                    </th>
                                    <th>
                                        <th><div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            @if($data->in_3 == '' or $data->in_3 == null)
                                            <input 
                                                type="time"  name="time_in3"
                                                id="time_in3" value="">
                                            @else
                                            <input 
                                                type="time" 
                                                id="time_in3" name="time_in3"
                                                value="{{ (date('H:i', strtotime($data->in_3))) }}" 
                                                class="time-input-style"
                                            >
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="name">TimeOut:</label>
                                            @if($data->out_3 == '' or $data->out_3 == null)
                                            <input 
                                                type="time"  name = "time_out3"
                                                id="time_out3" value="">
                                            @else
                                            <input 
                                                type="time" 
                                                id="time_out3" name = "time_out3"
                                                value="{{ (date('H:i', strtotime($data->out_3))) }}" 
                                                class="time-input-style"
                                            >
                                            @endif
                                        </div>
                                    </th>
                                    </th>
                                </table>
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
