@extends('landlord.shell')

@section('content')
    <h2 class="mb-4">Edit Room</h2>

    <form method="POST" action="{{ route('landlord.rooms.update', $room->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <!-- Room Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Room Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $room->name) }}"
                        required />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Room Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price (per month)</label>
                    <input type="number" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $room->price) }}"
                        required />
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Room Capacity -->
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" name="capacity" id="capacity"
                        class="form-control @error('capacity') is-invalid @enderror"
                        value="{{ old('capacity', $room->capacity) }}" required />
                    @error('capacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- ammenities --}}
                <div class="mb-3">
                    <label for="amenities" class="form-label">Amenities</label>
                    <input type="text" name="amenities" id="amenities"
                        class="form-control @error('amenities') is-invalid @enderror"
                        value="{{ old('amenities', $room->amenities ? implode(', ', $room->amenities) : '') }}"
                        placeholder="E.g., Wi-Fi, Air Conditioning, Heater" />
                    <small class="form-text text-muted">Enter amenities separated by commas.</small>
                    @error('amenities')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Room Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', $room->status) == 1 ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ old('status', $room->status) == 0 ? 'selected' : '' }}>Occupied</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Room Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                        rows="4">{{ old('description', $room->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <!-- Room Images -->
                <div class="mb-3">
                    <label for="images" class="form-label">Room Images</label>
                    <input type="file" name="images[]" id="images"
                        class="form-control @error('images') is-invalid @enderror" multiple />
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Current Images Preview -->
                    @if ($room->images->isNotEmpty())
                        <div class="mt-3">
                            <label for="current-images">Current Images</label>
                            <div class="row g-3">
                                @foreach ($room->images as $image)
                                    <div class="col-md-3">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Room Image"
                                                class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;" />
                                            <!-- Delete Button that triggers Modal -->
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteImageModal" data-image-id="{{ $image->id }}">
                                                &times; Delete
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>


                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('landlord.rooms.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">Update Room</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Image Confirmation Modal -->
    <div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteImageModalLabel">Confirm Image Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this image? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <form id="deleteImageForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteImageModal = document.getElementById('deleteImageModal');
                const deleteImageForm = document.getElementById('deleteImageForm');

                // Define the route with a placeholder for image ID
                const deleteImageRoute = @json(route('landlord.room-images.destroy', ['room_image' => '__image_id__']));

                deleteImageModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal
                    const imageId = button.getAttribute(
                        'data-image-id'); // Get the image ID from the button's data attribute

                    console.log('here');


                    // Dynamically update the form action with the image ID
                    const imageDeleteUrl = deleteImageRoute.replace('__image_id__', imageId);
                    console.log(imageDeleteUrl);

                    deleteImageForm.action = imageDeleteUrl; // Set the form's action to the correct URL
                });
            });
        </script>
    @endpush


@endsection
