@extends('tenant.shell')

@section('content')
    <h2 class="text-center mb-4">Available Rooms</h2>

    <!-- Room Cards -->
    <div class="row g-4">
        <!-- Room Cards Loop -->
        @forelse ($rooms as $room)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <!-- Room Image -->
                    @if ($room->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $room->images->first()->path) }}" alt="{{ $room->name }}"
                            class="card-img-top img-fluid" style="max-height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ $room->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top"
                            alt="{{ $room->name }}"
                            style="height: 200px; object-fit: cover; user-select: none; pointer-events: none;" />
                    @endif

                    <!-- Room Details -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $room->name }}</h5>
                        <p class="card-text">
                            <strong>Price:</strong> ${{ number_format($room->price, 2) }} / month <br>
                            <strong>Capacity:</strong> {{ $room->capacity }} tenants <br>
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $room->status ? 'success' : 'danger' }}">
                                {{ $room->status ? 'Available' : 'Occupied' }}
                            </span> <br>
                        </p>
                        <p class="card-text text-muted">
                            {{ Str::limit($room->description, 100, '...') }}
                        </p>
                        <a href="{{ route('tenant.rooms.show', $room->id) }}" class="btn btn-primary mt-auto">
                            View Details
                        </a>
                    </div>
                </div>
            </div>


        @empty
            <div class="col">
                <div class="alert alert-info" role="alert">
                    No rooms available.
                </div>
            </div>
        @endforelse

        <div class="d-flex justify-content-center mt-5">
            {{ $rooms->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
