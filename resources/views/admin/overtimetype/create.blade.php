<x-admin>
    @section('title', 'Create Overtime Type')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Overtime Type</h3>
            <div class="card-tools"><a href="{{ route('admin.overtimetype.index') }}" class="btn btn-sm btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.overtimetype.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="overtimetypecode" class="form-label">Overtime Type Code:*</label>
                            <input type="text" class="form-control" id="overtimetype" name="overtimetype"
                                placeholder="Enter Overtime Type" required >
                            <x-error>overtimetype</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="ottdescription" class="form-label">Description:*</label>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Enter Description" required >
                            <x-error>description</x-error>
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
