@extends('layouts.admin')
@section('title', 'Add Airport')
@section('content')
<!-- Add Airport Start -->
<div class="container pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-white">
        <h5 class="mb-4">Add Airport</h5>
        <form action="{{ url('admin/store-airport') }}" method="POST" enctype="multipart/form-data">
            @csrf  
            <div class="form-floating mb-3">
                <input type="text" class="form-control bg-dark" name="code" placeholder=" " required>
                <label for="">Code</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control bg-dark" name="airport" placeholder=" " required>
                <label for="">Airport</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="location" placeholder=" " required>
                <label for="">Location</label>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Airport End -->
@endsection
