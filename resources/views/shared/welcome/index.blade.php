@extends('shared.shell')

@section('content')
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1 class="display-4 text-primary">Welcome to Aparri Rooms</h1>
            <p class="lead text-muted">Your one-stop platform for finding the best boarding houses in Aparri.</p>

            <!-- Display the first 5 rooms -->
            @if ($rooms->isNotEmpty())
                <div class="rooms-list">
                    <h3 class="mb-3">Available Rooms</h3>
                    <div class="row">
                        @foreach ($rooms as $room)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $room->images->first()->path ?? 'default-image.jpg') }}"
                                        class="card-img-top" alt="Room Image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $room->name }}</h5>
                                        <p class="card-text">{{ Str::limit($room->description, 100) }}</p>
                                        <a href="{{ route('tenant.rooms.show', $room->id) }}"
                                            class="btn btn-primary mt-auto">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p>No rooms available.</p>
            @endif

            <!-- Button to View More Rooms -->
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg mt-4">Login to View More</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg mt-4">Get Started</a>
        </div>
</div>@endsection
