<x-admin>
    @section('title', 'Edit Work Schedule')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Work Schedule</h3>
                        <div class="card-tools">
                            <a href="{{ route('attendance.workschedule.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('attendance.workschedule.update', $data) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblWorkSchedule" class="form-label">Schedule Name:*</label>
                                    <input type="text" class="form-control" id="KeySchedule" name="KeySchedule"
                                        placeholder="Enter Schedule Name" value="{{ $data->KeySchedule }}" required>
                                    <x-error>KeySchedule</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblRemarks" class="form-label">Start Time:*</label>
                                    <input type="time" class="form-control" id="starttime" name="starttime"
                                        placeholder="Enter Start Time" value={{Carbon\Carbon::parse($data->StartTime)->format('H:i A')}} required>
                                    <x-error>starttime</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblRemarks" class="form-label">End Time:*</label>
                                    <input type="time" class="form-control" id="endtime" name="endtime"
                                        placeholder="Enter End Time" value={{Carbon\Carbon::parse($data->EndTime)->format('H:i A')}} required>
                                    <x-error>endtime</x-error>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lblRemarks" class="form-label">Grace Period:*</label>
                                    <input type="number" class="form-control" id="GracePeriod" name="GracePeriod"
                                        placeholder="Enter Grace Period" value="{{ $data->GracePeriodMins }}" required>
                                    <x-error>GracePeriod</x-error>
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
