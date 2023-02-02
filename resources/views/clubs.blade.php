@extends('layouts.index')

@section('content')
    <h1 class="mb-3">Clubs</h1>

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createClubModal">Create
        Club</button>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Club</th>
                <th scope="col">City</th>
                <th scope="col">Point</th>
                <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($clubs->isEmpty())
                <tr>
                    <td colspan="5">No Data Found</td>
                </tr>
            @else
                @foreach ($clubs as $club)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $club->name }}</td>
                        <td>{{ $club->city }}</td>
                        <td>{{ $club->point }}</td>
                        <td><button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editClubModal">Edit</button></td>
                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @foreach ($errors->all() as $message)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed - {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach

    <!-- Create Club Modal -->
    <div class="modal fade" id="createClubModal" tabindex="-1" aria-labelledby="createClubModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createClubModalLabel">Create New Club</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/clubs/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Club Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Club Modal -->
    <div class="modal fade" id="editClubModal" tabindex="-1" aria-labelledby="editClubModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editClubModalLabel">Edit Club</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/clubs/update" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Club Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
