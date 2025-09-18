<x-admin>
    @section('title','SSS TABLE Management')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SSS Table</h3>
            <div class="card-tools">
                {{-- <a href="{{ route('attendance.holiday.create') }}" class="btn btn-sm btn-info">New</a> --}}
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
            <form action="{{ route('attendance.ssstable.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
                    <a href="{{ route('attendance.sssreference.downloadtemplate') }}" class="btn btn-primary">Download Template</a>
                </div>
                
                
            </form>    
        </div>
        <div class="card-body">
            <table class="table table-striped" id="HolidayTable">
                <thead>
                    <tr align = "center">
                        <th>Comphensation Range From</th>
                        <th>Comphensation Range To</th>
                        <th>Monthly Salary Credit(EC)</th>
                        <th>Monthly Salary Credit(MPF)</th>
                        <th>Total</th>
                        <th>Employer Reg SS</th>
                        <th>Employer MPF</th>
                        <th>Employer EC</th>
                        <th>Total</th>
                        <th>Employee Reg SS</th>
                        <th>Employee MPF</th>
                        <th>Employee EC</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $sd)
                        <tr>
                            <th>{{ number_format($sd->StartRangeComp,2) }}</th>
                            <th>{{ number_format($sd->EndRangeComp,2) }}</th>
                            <th>{{ number_format($sd->EC,2) }}</th>
                            <th>{{ number_format($sd->MPF,2) }}</th>
                            <th>{{ number_format($sd->MSCTOTAL,2) }}</th>
                            <th>{{ number_format($sd->EMPLOYERREGSSS,2) }}</th>
                            <th>{{ number_format($sd->EMPLOYERMPF,2) }}</th>
                            <th>{{ number_format($sd->EMPLOYEREC,2) }}</th>
                            <th>{{ number_format($sd->EMPLOYERTOTAL,2) }}</th>
                            <th>{{ number_format($sd->EMPLOYEEREGSS,2) }}</th>
                            <th>{{ number_format($sd->EMPLOYEEMPF,2) }}</th>
                            <th>{{ number_format($sd->EMPLOYEETOTAL,2) }}</th>
                            <th>{{ number_format($sd->TOTAL,2) }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @section('js')
        <script>
            $(function() {
                $('#HolidayTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                    pageLength: 25,
                });
            });
        </script>
    @endsection
</x-admin>
