<x-admin>
    @section('title', 'Auto Deduction Entry')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">PAG-IBIG (HDMF) Auto Deduction Table</h3>
            <div class="card-tools">
                {{-- <a href="{{ route('deductions.loans.create') }}" class="btn btn-sm btn-info">New</a> --}}
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
        {{-- <div class="card-body">
            Filter:
            <form action="{{ route('deductions.loans.list') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="employeecode" class="form-label">Employee Code:*</label>
                            <div class="search-dropdown">
                                <div class="dropdown-display" 
                                    id="dropdownDisplay">Select Employee</div>
                                <div class="dropdown-content"
                                    id="dropdownContent">
                                    <input type="text" 
                                        class="search-input" 
                                        id="searchInput"
                                        placeholder="Search Employee">
                                    <ul id="dropdownList">
                                        @foreach ($employee as $emp)
                                        <li>{{ $emp->employeenumber }} : {{ $emp->lastname.','.$emp->firstname.' '.$emp->middlename }} </li>                                
                                        @endforeach
                                    </ul>
                                </div>
                            </div>  
                            <x-error>employeecode</x-error>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-md btn-secondary">Clear All</a>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="employee">Employee Number:</label>
                            <input type="string" class="form-control" id="empcode" name="empcode"
                                placeholder="Enter Employee Number" required readonly >
                            <x-error>employeecode</x-error>
                        </div>    
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="selectmonth">Start Date:</label>
                            <input type="date" id="startdate" value="" name="startdate"/>
                            <x-error>monthfilter</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="selectmonth">End Date:</label>
                            <input type="date" id="enddate" name="enddate"/>
                            <x-error>monthfilter</x-error>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="button-container">
                                <button class="btn btn-success"><i class="fa fa-file"></i> Search</button>
                                <a href="{{ route('deductions.loans.index') }}" id="ShowAll" class="btn btn-md btn-info">Show All</a>
                                @csrf
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}
        <div class="card-body">
            <a onClick="processAutoDeduct()" class="btn btn-lg btn-info">Proces HDMF (AD)</a>
            <div style="height:50px;"></div>
            <table class="table table-striped" id="hdmfTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Deduction Date</th>
                        <th>Cut-off</th>
                        <th>Deduction Name</th>
                        <th>Amount</th>
                        <th>Date Process</th>
                        <th>Process By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ltDet)
                        <tr>
                            <td>{{ $ltDet->id }}</td>
                            <td>{{ $ltDet->EmployeeCode }}</td>
                            <td>{{ $ltDet->EmployeeName }}</td>
                            <td>{{ $ltDet->DeductionDate }}</td>
                            <td>{{ $ltDet->StartDate }} to {{ $ltDet->EndDate }} </td>
                            <td>{{ $ltDet->DeductionName }}</td>
                            <td>{{ $ltDet->Amount }}</td>
                            <td>{{ $ltDet->DateProcess }}</td>
                            <td>{{ $ltDet->ProcessedBy }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @section('js')
            <script>
                $(function() {
                    $('#hdmfTable').DataTable({
                        "paging": true,
                        "searching": true,
                        "ordering": true,
                        "responsive": true,
                    });
                });
            </script>
            <script>
                function processAutoDeduct() {
                    let result = confirm("Are you sure you want to Process?");
                    if (result == true) {
                        $.ajax({
                            url: '/deductions/processDeductionHDMF',
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                               location.reload(true);
                            }
                        });
                    }
                    location.reload(true)
                }
            </script>
        @endsection
</x-admin>
