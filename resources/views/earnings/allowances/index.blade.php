<x-admin>
    @section('title','Loan Entry')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Loan Table</h3>
            <div class="card-tools">
                <a href="{{ route('deductions.loans.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
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
            Filter:
            <form action="{{ route('attendance.rawattendance.list') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="selectmonth">Start Date:</label>
                            <input type="date" id="start-date" value=""/>
                            <x-error>monthfilter</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="selectmonth">End Date:</label>
                            <input type="date" id="end-date" />
                            <x-error>monthfilter</x-error>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="employee">Employee:</label>
                            <select name="employeecode" id="employeecode" class="form-control">
                                <option value="" selected disabled>select employee</option>
                            </select>
                            <x-error>employeecode</x-error>
                        </div>
                    </div>
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
                        <th>Action</th>
                        <th></th>
                        <th></th>
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
                            <td><a href="{{ route('deductions.loans.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td><a href="{{ route('admin.loantype.edit', encrypt($ltDet->id)) }}"
                                    class="btn btn-sm btn-primary">Approve</a></td>
                            <td>
                                <form action="{{ route('admin.loantype.destroy', encrypt($ltDet->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
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
 <script>
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), 1);;
    const FirstDate = today.toLocaleDateString('en-CA'); // 'en-CA' uses the yyyy-mm-dd format
    const LastDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    const EndDate = LastDate.toLocaleDateString('en-CA'); 
    
    // Set the value of the input field
    document.getElementById('start-date').value = FirstDate;
    document.getElementById('end-date').value = EndDate;
    $("#start-date").change(function(){
    $("#end-date").prop("min", $(this).val());
    $("#end-date").val(""); //clear end date input when start date changes
    });
  </script>