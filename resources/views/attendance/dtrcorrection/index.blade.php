<x-admin>
    @section('title','DTR Correction')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DTR Correction Table</h3>
            <div class="card-tools">
                <a href="{{ route('attendance.dtrcorrection.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>

    <div class="card-header">
  
            @session('success')
                <div class="alert alert-success" role="alert"> 
                    {{ $value }}
                </div>
            @endsession
            @session('failed')
                <div class="alert alert-danger" role="alert"> 
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
         <div class="col-lg-3">
            <form action="{{ route('attendance.dtrcorrection.list') }}" method="POST">
                @csrf
                        <div class="form-group">
                            <label for="selectmonth">Month:</label>
                            <select name="monthfilter" id="monthfilter" class="form-control" required>
                                @if($monthfilter == 0)
                                    <option value="" selected disabled>select month</option>
                                    @for ($month = 1; $month <= 12; $month++)
                                        {{ $monthName = date('F', mktime(0, 0, 0, $month, 1)) }}
                                        <option value="{{ $month }}">
                                            {{ $monthName }} </option>
                                    @endfor
                                @else
                                    @for ($month = 1; $month <= 12; $month++)
                                        {{ $monthName = date('F', mktime(0, 0, 0, $month, 1)) }}
                                        @if($month == $monthfilter)
                                            <option value="{{ $month }}" selected>
                                                {{ $monthName }} </option>
                                        @else
                                            <option value="{{ $month }}">
                                                {{ $monthName }} </option>
                                        @endif
                                    @endfor
                                @endif
                            </select>
                            <x-error>monthfilter</x-error>
                        </div>
                        <button class="btn btn-success" name = "search" id="search">Search</button>
                        {{-- <a href="{{ route('attendance.dtrcorrection.list', encrypt($ltDet->id)) }}" class="btn btn-md btn-info">Search</a> --}}
                    </div>
                </form>
        <div class="card-body">
            <table class="table table-striped" id="dtrCorTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Day Type</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Approved By</th>
                        <th width = "250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ltDet)
                        <tr>
                            <td><a href="{{ route('attendance.dtrcorrection.view', encrypt($ltDet->id)) }}">{{ $ltDet->id }}</a></td>
                            <td>{{ $ltDet->employeenumber}}</td>
                            <td>{{ $ltDet->Employee }}</td>
                            <td>{{ $ltDet->date }}</td>
                            <td>{{ $ltDet->IN }}</td>
                            <td>{{ $ltDet->OUT }}</td>
                            <td>{{ $ltDet->DType }}</td>
                            @if($ltDet->Status == "Declined")
                                <td style="color:red;">{{ $ltDet->Status }}</td>
                            @else
                                <td>{{ $ltDet->Status }}</td>
                            @endif
                            <td>{{ $ltDet->CreatedBy }}</td>
                            <td>{{ $ltDet->ApprovedBy }}</td>
                            
                            {{-- <td>{{ $ltDet->Status }}</td> --}}
                            <td><div style="display:inline-block;margin-right:5px;"><a href="{{ route('attendance.dtrcorrection.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('attendance.dtrcorrection.destroy', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('attendance.dtrcorrection.approve', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to approve?')">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                </div>
                                <div style="display:inline-block;margin-right:5px;">
                                <form action="{{ route('attendance.dtrcorrection.decline', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to Decline?')">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning">Decline</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @section('js')
        <script>
            $(function() {
                $('#dtrCorTable').DataTable({
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
        // Get references to the dropdown and button
        const dropdown = document.getElementById('monthfilter');
        const button = document.getElementById('search');

        // Attach the change event listener to the dropdown
        dropdown.addEventListener('change', function () {
            // Trigger the button click programmatically
            button.click();
        });
    </script>