@extends('layouts.front')

@section('title', 'Feedback')
@section('content')
    <div class="container mt-5" style="max-width: 800px;">
        <h1 class="text-center mb-4">Feedback</h1>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Combined Feedback Display and Input Form -->
        <div class="card">
            <div class="card-body">

                <!-- Existing Feedback Display -->
                @if ($feedback->isEmpty())
                    <p class="m-3">No user feedback available.</p>
                @else
                    <ul style="list-style: none; padding: 0;">
                        @foreach ($feedback as $f)
                            <li class="m-3">
                                <p><strong>User Name:</strong></p>
                                <p class="ms-5">{{ $f->user->first_name }} {{ $f->user->last_name }}</p>
                                <p><strong>Rating:</strong></p>
                                <p class="ms-5">{!! renderStars($f->rating) !!}</p>
                                <p><strong>Comment:</strong></p>
                                <p class="ms-5 mb-5">{{ $f->comment }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Feedback Input Form -->
                <form action="{{ route('rate-flight') }}" method="POST" class="mt-4">
                    @csrf

                    <!-- Rate Your Experience -->
                    <div class="m-3">
                        <label for="rating" class="form-label">Rate Your Experience:</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="1 star"></label>
                        </div>
                    </div>

                    <!-- Comment -->
                    <div class="m-3">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary ms-3">Submit Feedback</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@php
    function renderStars($rating) {
        $fullStars = floor($rating);
        $halfStar = ceil($rating - $fullStars);
        $emptyStars = 5 - $fullStars - $halfStar;

        $starHtml = str_repeat('<i class="bi bi-star-fill text-warning"></i>', $fullStars);
        $starHtml .= str_repeat('<i class="bi bi-star-half text-warning"></i>', $halfStar);
        $starHtml .= str_repeat('<i class="bi bi-star text-warning"></i>', $emptyStars);

        return $starHtml;
    }
@endphp

<style>
    /* Add this to your existing styles or create a new style block */
    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 1.5em;
        padding: 0.3em;
        cursor: pointer;
        float: right;
    }

    .star-rating label:before {
        content: '\2605'; /* Unicode character for a star */
    }

    .star-rating input[type="radio"]:checked~label:before {
        color: #ffcc00; /* Color for the selected stars */
    }
</style>
