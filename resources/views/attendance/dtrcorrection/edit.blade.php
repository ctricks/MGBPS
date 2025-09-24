<x-admin>
    @section('title', 'Edit DTR Correction Type')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit DTR Correction : {{$employeename}}</h3>
                        <div class="card-tools">
                            <a href="{{ route('attendance.dtrcorrection.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('attendance.dtrcorrection.update', $data) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Description:*</label>
                                    <input type="string" class="form-control" id="description" name="description"
                                        placeholder="Enter Description" value = "{{ $data->Remarks }}" required >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Date:*</label>
                                    <input type="date" class="form-control" id="StartDate" name="StartDate"
                                        placeholder="Enter Date" value = "{{ $data->date }}" required >
                                    <x-error>StartDate</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            <input 
                                                type="time"  
                                                id="time_in" name="time_in" value="{{ (date('H:i', strtotime($data->IN))) }}">
                                                <label for="name">TimeOUT:</label>
                                            <input 
                                                type="time"  
                                                id="time_in" name="time_out" value="{{ (date('H:i', strtotime($data->OUT))) }}">
                                </div>
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
