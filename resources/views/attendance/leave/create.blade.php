<x-admin>
    @section('title', 'Create Leave Type')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Leave Type</h3>
            <div class="card-tools"><a href="{{ route('attendance.leavetype.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('attendance.leavetype.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="empnumber" class="form-label">Leave Type Name:*</label>
                            <input type="text" class="form-control" id="leavetype" name="leavetype"
                                placeholder="Enter Leave Type" required >
                                <x-error>KeySchedule</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Description:*</label>
                            <input type="string" class="form-control" id="description" name="description"
                                placeholder="Enter Description" required >
                        </div>
                    </div>
                    <div class="col-lg-4">
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
