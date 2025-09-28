<x-admin>
    @section('title','Deduction Table')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Deduction Details</h3>
            <div class="card-tools">
                <a href="{{ route('deductions.deductiondetails.create') }}" class="btn btn-sm btn-info">New</a>
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
<div class="card-body">
            Filter:
            <form action="{{ route('deductions.deduction.list') }}" method="POST">
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
                    {{-- <div class="col-lg-12">
                        <div class="form-group">
                            <label for="employee">Description:*</label>
                            <input type="string" class="form-control" id="description" name="description"
                                placeholder="Enter Description " required  >
                            <x-error>description</x-error>
                        </div>
                    </div> --}}
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
                                <a href="{{ route('deductions.loans.index') }}" class="btn btn-md btn-info">Show All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="loanTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Loan Date</th>
                        <th>Employee Code</th>
                        <th>Type of Loan</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>No of Payment</th>
                        <th>Status</th>
                        <th width="350px;">Action</th>
                        {{-- <th></th>
                        <th></th>
                        <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ltDet)
                        <tr>
                            <td>{{ $ltDet->id }}</td>
                            <td>{{ Carbon\Carbon::parse($ltDet->LoanDate)->format('m-d-Y') }}</td>
                            <td>{{ $ltDet->employeenumber }}</td>
                            <td>{{ $ltDet->LoanType }} </td>
                            <td>{{ $ltDet->Description }}</td>
                            <td>{{ $ltDet->Amount }}</td>
                            <td>{{ $ltDet->NoOfPayment}}</td>
                            <td>{{ str_replace('_',' ',$ltDet->Status) }}</td>
                            <td><div style="display: flex; gap: 10px;">
                                <a href="{{ route('deductions.loans.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">View Details</a>
                                
                                    {{-- <a href="{{ route('deductions.loans.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a> --}}
                                
                                    <a href="{{ route('deductions.loans.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Approve</a>

                                    <a href="{{ route('deductions.loans.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-warning">Declined</a>
                               
                                    <form action="{{ route('deductions.loans.destroy', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
                $('#loanTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
 