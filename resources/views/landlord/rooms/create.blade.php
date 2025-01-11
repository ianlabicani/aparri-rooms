@extends('landlord.shell')

@section('content')
    <h1 class="my-4">Add a Room</h1>
    <form action="{{ route('landlord.rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Room Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="amenities" class="form-label">Amenities</label>
            <input type="text" class="form-control" id="amenities" name="amenities" placeholder="Comma-separated">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="1" selected>Available</option>
                <option value="0">Occupied</option>
            </select>
        </div>
        <!-- Image Upload -->
        <div class="mb-3">
            <label for="images" class="form-label">Room Images</label>
            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Add Room</button>
    </form>
@endsection
