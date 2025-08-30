<x-admin>
    @section('title', 'Create Civil Status')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Civil Status</h3>
            <div class="card-tools"><a href="{{ route('admin.civilstatus.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.civilstatus.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="civilstatus" class="form-label">Civil Status:*</label>
                            <input type="text" class="form-control" name="civilstatus" required
                                value="{{ old('name') }}">
                                <x-error>civilstatus</x-error>
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
