<x-admin>
    @section('title', 'Create Employee Status')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Employee Status</h3>
            <div class="card-tools"><a href="{{ route('admin.employeestatus.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.employeestatus.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="employeestatus" class="form-label">Employee Status:*</label>
                            <input type="text" class="form-control" name="employeestatus" required
                                value="{{ old('employeestatus') }}">
                                <x-error>employeestatus</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description" class="form-label">Description:</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ old('description') }}">
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
