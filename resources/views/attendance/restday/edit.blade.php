<x-admin>
    @section('title', 'Edit Restday')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Restday</h3>
                        <div class="card-tools">
                            <a href="{{ route('attendance.restday.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('attendance.restday.update', $data) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblRestday" class="form-label">Restday:*</label>
                                    <select name="Restday" id="Restday" class="form-control" required>
                                        <option value="" selected disabled>Select Rest Day</option>
                                        <option value="Sunday" selected>Sunday</option>
                                        <option value="Monday" selected>Monday</option>
                                        <option value="Tuesday" selected>Tuesday</option>
                                        <option value="Wednesday" selected>Wednesday</option>
                                        <option value="Thursday" selected>Thursday</option>
                                        <option value="Friday" selected>Friday</option>
                                        <option value="Saturday" selected>Saturday</option>
                                    </select>
                                    <x-error>Restday</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblRemarks" class="form-label">Remarks:</label>
                                    <input type="text" class="form-control" id="Remarks" name="Remarks"
                                        placeholder="Enter Remarks" multiline>
                                    <x-error>Remarks</x-error>
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
