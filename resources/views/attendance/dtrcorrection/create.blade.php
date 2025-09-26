<x-admin>
    @section('title', 'Create DTR Correction')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create DTR Correction</h3>
            <div class="card-tools"><a href="{{ route('attendance.dtrcorrection.index') }}" class="btn btn-sm btn-dark">Back</a></div>
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
                    </div>
            <form action="{{ route('attendance.dtrcorrection.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="name">Employee Number:*</label>
                            <input type="string" class="form-control" id="empcode" name="empcode"
                                placeholder="Enter Employee Number" required readonly >
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="name">Description:*</label>
                            <input type="string" class="form-control" id="description" name="description"
                                placeholder="Enter Description" required >
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="name">Date:*</label>
                            <input type="date" class="form-control" id="StartDate" name="StartDate"
                                placeholder="Enter Date" required >
                            <x-error>StartDate</x-error>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        {{-- <div class="form-group">
                            <label for="name">End Date:*</label>
                            <input type="date" class="form-control" id="EndDate" name="EndDate"
                                placeholder="Enter Date" required >
                                <x-error>EndDate</x-error>
                        </div> --}}
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            <input 
                                                type="time"  
                                                id="time_in" name="time_in" value="">
                                                <label for="name">TimeOUT:</label>
                                            <input 
                                                type="time"  
                                                id="time_in" name="time_out" value="">
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
{{-- <script>
        $(document).ready(function () {
            $('#dropdownDisplay').on('click', function () {
                $('#dropdownContent').toggle();
            });

            $('#searchInput').on('input', function () {
                let value = $(this).val().toLowerCase();
                $('#dropdownList li').filter(function () {
                    $(this).toggle($(this).text()
                           .toLowerCase().indexOf(value) > -1);
                });
            });

            $('#dropdownList').on('click', 'li', function () {
                $('#dropdownDisplay').text($(this).text());
                $('#dropdownContent').hide();
            });

            $(document).on('click', function (e) {
                if (!$(e.target).closest('.search-dropdown').length) {
                    $('#dropdownContent').hide();
                }
            });
        });
    </script> --}}
