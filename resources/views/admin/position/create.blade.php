<x-admin>
    @section('title', 'Create Position')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Position</h3>
            <div class="card-tools"><a href="{{ route('admin.position.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.position.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="position" class="form-label">Position:*</label>
                            <input type="text" class="form-control" name="position" required
                                value="{{ old('position') }}">
                                <x-error>position</x-error>
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
                                <option value="1">Active</option>
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
