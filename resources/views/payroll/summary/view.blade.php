<x-admin>
    @section('title','View Payroll Summary')
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Payroll Table Period: {{ $cutoffDataSelected }}</h3>
            <div class="card-tools">
                <a href="{{ route('payroll.payroll.index') }}" class="btn btn-sm btn-info">Back</a>
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
          <form class="needs-validation" novalidate action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Number:*</label>
                                <input type="text" class="form-control" name="employeenumber" required numeric
                                    value="{{ $data[0]->Employee_Code }}" readonly>
                                    <x-error>employeenumber</x-error>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Name:*</label>
                                <input type="text" class="form-control" name="employeename" required numeric
                                    value="{{ $data[0]->EmployeeName }}" readonly>
                                    <x-error>employeenumber</x-error>
                            </div>
                        <div class = "form-group col-lg-12">
                                <button type="submit" class="btn btn-primary float-left">Save</button>
                        </div>
            </form>  
    </div>
</x-admin>
<script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#monthfilter').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#cutoff').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-cutoff/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.StartDate +
                                            ' to ' + response.EndDate, response.id);
                                        // Append the new option to the dropdown
                                        $('#cutoff').append(newOption);
                                    });
                                }
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#cutoff').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#employeecode').find('option').remove().end();
                       
                        if(id > 0)
                        {
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-dtr-employee/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.employee_code, response.id);
                                        // Append the new option to the dropdown
                                        $('#employeecode').append(newOption);
                                    });
                                }

                            }
                        });
                        }
                    });
                });
            </script>