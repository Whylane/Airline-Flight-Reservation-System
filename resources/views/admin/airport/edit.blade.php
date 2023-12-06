@extends('layouts.admin')
@section('title', 'Add Airport')
@section('content')
<!-- Update Airport Start -->
<div class="container pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-white">
        <h5 class="mb-4">Update Airport</h5>
        <form action="{{ url('admin/update-airport/'.$airports->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="code" placeholder=" " value="{{ strtoupper($airports->code) }}">
                <label for="">Code</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="airport" placeholder=" " value="{{ $airports->airport }}">
                <label for="">Airport</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="location" placeholder=" " value="{{ $airports->location }}">
                <label for="">Location</label>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Update Airport End -->
@endsection
