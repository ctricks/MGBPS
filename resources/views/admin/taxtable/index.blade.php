<x-admin>
    @section('title','TAX TABLE Management')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">TAX Table</h3>
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
            <form action="{{ route('attendance.taxtable.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" style="margin-right:30px;">
                <p></p>
                <div class="button-container">
                    <button class="btn btn-success"><i class="fa fa-file"></i> Import User Data</button>
                    <a href="{{ route('attendance.taxreference.downloadtemplate') }}" class="btn btn-primary">Download Template</a>
                </div>
                
                
            </form>    
        </div>
        <div class="card-body">
            <table class="table table-striped" id="TaxTable">
                <thead>
                    <tr align = "center">
                        <th>ID</th>
                        <th>Start Range</th>
                        <th>End Range</th>
                        <th>Over Minimum Amount</th>
                        <th>Additional Percentage</th>
                        <th>Additional Pay</th>
                        <th>Payout</th>
                        <th>Year</th>
                        <th>Uploaded By</th>
                        <th>Uploaded Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $sd)
                        <tr>
                            <th>{{ $sd->id }}</th>
                            <th>{{ number_format($sd->StartRange,2) }}</th>
                            <th>{{ number_format($sd->EndRange,2) }}</th>
                            <th>{{ number_format($sd->OverMinimum,2) }}</th>
                            <th>{{ number_format($sd->AddPercent,2) }}</th>
                            <th>{{ number_format($sd->AdditionalPay,2) }}</th>
                            <th>{{ $sd->PayType }}</th>
                            <th>{{ $sd->Year }}</th>
                            <th>{{ $sd->UploadedBy }}</th>
                            <th>{{ $sd->updated_at }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @section('js')
        <script>
            $(function() {
                $('#TaxTable').DataTable({
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
