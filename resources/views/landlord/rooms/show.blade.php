<!-- TODO: Fix styling -->

@extends('landlord.shell')

@section('content')
    <a href="{{ route('landlord.rooms.index') }}" class="btn btn-secondary mb-4">
        &larr; Back to Room List
    </a>

    <div class="card mb-4">
        <!-- Room Images -->
        <div class="card-header bg-light">
            <h5 class="text-center">Room Images</h5>
        </div>
        <div class="card-body">
            @if ($room->images->isNotEmpty())
                <div class="row g-2">
                    @foreach ($room->images as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded mb-2"
                                alt="{{ $room->name }}"
                                style="height: 200px; object-fit: cover; width: 100%; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal{{ $loop->index }}" />

                            <!-- Modal -->
                            <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1"
                                aria-labelledby="imageModalLabel{{ $loop->index }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel{{ $loop->index }}">Room Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded"
                                                alt="{{ $room->name }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted">No images available for this room.</p>
            @endif
        </div>

        <!-- Room Details -->
        <div class="card-header bg-light">
            <h5 class="text-center">Room Details</h5>
        </div>
        <div class="card-body">
            <h2 class="card-title">{{ $room->name }}</h2>
            <p class="text-muted">
                <strong>Room ID:</strong> {{ $room->id }}
            </p>
            <p>
                <strong>Price:</strong> ${{ number_format($room->price, 2) }} / month
            </p>
            <p>
                <strong>Capacity:</strong> {{ $room->capacity }} tenants
            </p>
            <p>
                <strong>Status:</strong>
                <span class="badge bg-{{ $room->status ? 'success' : 'danger' }}">
                    {{ $room->status ? 'Available' : 'Occupied' }}
                </span>
            </p>
            <p>
                <strong>Amenities:</strong>
                {{ is_array($room->amenities) && count($room->amenities) > 0 ? implode(', ', $room->amenities) : 'No amenities available.' }}
            </p>

            <p>
                <strong>Description:</strong><br>
                {{ $room->description ?? 'No description available.' }}
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="card-footer text-center">
            <a href="{{ route('landlord.rooms.edit', $room->id) }}" class="btn btn-primary me-2">
                Edit Room
            </a>
            <form action="{{ route('landlord.rooms.destroy', $room->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Are you sure you want to delete this room?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Room</button>
            </form>
        </div>
    </div>

@endsection
