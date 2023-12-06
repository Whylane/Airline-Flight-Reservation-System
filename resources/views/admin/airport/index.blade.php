@extends('layouts.admin')
@section('title', 'Airport')
@section('content')
  <!-- Airport Lists Start -->
  <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Airline Lists</h5>
            <a href="{{ url('admin/create-airport') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Airport</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle table-borderless table-hover mb-0 text-center">
                <thead>
                    <tr class="text-white table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Airport</th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($airports as $airport)
                    <tr>
                        <td>{{ $airport ->id }}</td>
                        <td>{{ strtoupper($airport->code) }}</td>
                        <td>{{ $airport->airport }}</td>
                        <td>{{ $airport->location }}</td>
                        <td>
                            <a href="{{ url('admin/edit-airport/'.$airport->id) }}" class="btn btn-success btn-sm">Update</a>
                        </td>
                    </tr>   
                    @endforeach   
                </tbody>
            </table>
        </div>
    </div>
</div>
  <!-- Airport Lists End -->
@endsection
