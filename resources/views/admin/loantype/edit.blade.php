<x-admin>
    @section('title', 'Edit Loan Type')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Loan Type</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.loantype.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.loantype.update', $data) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblloantype" class="form-label">Leave Type Name:*</label>
                                    <input type="text" class="form-control" id="LoanType" name="LoanType"
                                        placeholder="Enter Leave Type Name" value="{{ $data->LoanType }}" required>
                                    <x-error>LoanType</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblRemarks" class="form-label">Description:*</label>
                                    <input type="text" class="form-control" id="Description" name="Description"
                                        placeholder="Enter Description" value={{$data->Description}} required>
                                    <x-error>description</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="isActive" class="form-label">Active:*</label>
                                    <select name="isActive" id="isActive" class="form-control" required>
                                        <option value="" selected disabled>Select Record Status</option>
                                        <option value="1" selected>Active</option>
                                        <option value="0">In-active</option>
                                    </select>
                                    <x-error>isActive</x-error>
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
