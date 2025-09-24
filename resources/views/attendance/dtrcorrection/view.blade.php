<x-admin>
    @section('title', 'View DTR Correction')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">View DTR Correction : {{$data[0]->Employee}}</h3>
                        <div class="card-tools">
                            <a href="{{ route('attendance.dtrcorrection.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    {{-- <form class="needs-validation" novalidate action="{{ route('attendance.dtrcorrection.update', $data) }}"
                        method="POST">
                        @method('PUT')
                        @csrf --}}
                        <input type="hidden" name="id" value="{{ $data[0]->id }}">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Description:*</label>
                                    <input type="string" class="form-control" id="description" name="description" readonly
                                        placeholder="Enter Description" value = "{{ $data[0]->Remarks }}" required >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Date:*</label>
                                    <input type="date" class="form-control" id="StartDate" name="StartDate" readonly
                                        placeholder="Enter Date" value = "{{ $data[0]->date }}" required >
                                    <x-error>StartDate</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                            <label for="name">TimeIN:</label>
                                            <input 
                                                type="time" readonly
                                                id="time_in" name="time_in" value="{{ (date('H:i', strtotime($data[0]->IN))) }}">
                                                <label for="name">TimeOUT:</label>
                                            <input 
                                                type="time" readonly
                                                id="time_in" name="time_out" value="{{ (date('H:i', strtotime($data[0]->OUT))) }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Status:</label>
                                    <input type="text" class="form-control" id="Status" name="Status" readonly
                                        placeholder="Enter Created By" value = "{{ $data[0]->Status }}">
                                    <x-error>Status</x-error>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Created By:</label>
                                    <input type="text" class="form-control" id="CreatedBy" name="CreatedBy" readonly
                                        placeholder="Enter Created By" value = "{{ $data[0]->CreatedBy }}">
                                    <x-error>CreatedBy</x-error>
                                </div>
                                <div class="form-group">
                                    <label for="name">Created Date:</label>
                                    <input type="text" class="form-control" id="CreatedDate" name="CreatedDate" readonly
                                        placeholder="Enter Created Date" value = "{{ $data[0]->created_at }}">
                                    <x-error>CreatedBy</x-error>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Approved By:</label>
                                    <input type="text" class="form-control" id="ApprovedBy" name="ApprovedBy" readonly
                                        placeholder="Enter Approved By" value = "{{ $data[0]->ApprovedBy }}">
                                    <x-error>CreatedBy</x-error>
                                </div>
                                <div class="form-group">
                                    <label for="name">Approved Date:</label>
                                    <input type="text" class="form-control" id="ApprovedDate" name="ApprovedDate" readonly
                                        placeholder="Enter Approved Date" value = "{{ $data[0]->ApprovedDate }}">
                                    <x-error>ApprovedDate</x-error>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{-- <button type="submit" class="btn btn-primary float-right">Update</button> --}}
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
</x-admin>
