<x-admin>
    @section('title', 'Edit Position')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Position</h3>
            <div class="card-tools"><a href="{{ route('admin.position.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.position.update',$position) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $position->id }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="position" class="form-label">Position:*</label>
                            <input type="text" class="form-control" name="position" required
                                value="{{ $position->PositionName }}">
                                <x-error>position</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description" class="form-label">Description:</label>
                            <input type="text" class="form-control" name="description" 
                                value="{{ $position->Description }}">
                                <x-error>description</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="isActive" class="form-label">Active:*</label>
                            <select name="isActive" id="isActive" class="form-control" required>
                                <option value="" selected disabled>Select Record Status</option>
                                 @if($position->isActive)
                                    <option value="1" selected>Active</option>
                                    <option value="0">In-active</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>In-active</option>
                                @endif
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
