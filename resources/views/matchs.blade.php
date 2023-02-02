@extends('layouts.index')

@section('content')
    <h1 class="mb-3">Matchs</h1>

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createMatchModal">Create
        Match</button>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Club</th>
                <th scope="col">Winning Club</th>
                <th scope="col">Losing Club</th>
                <th scope="col">Draw</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        <tbody>
            @if ($matchs->isEmpty())
                <tr>
                    <td colspan="7">No Data Found</td>
                </tr>
            @else
                @foreach ($matchs as $match)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{-- Create Match Modal --}}
    <div class="modal fade" id="createMatchModal" tabindex="-1" aria-labelledby="createMatchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createMatchModalLabel">Create New Match</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/matchs/store" method="POST" id="match-form-post">
                    @csrf
                    <div class="modal-body" id="match-form">
                        <button type="button" class="btn btn-primary mb-3" id="add-match-form">Add Form</button>
                        <div class="row">
                            <div class="col d-flex">
                                <div class="mb-3">
                                    <select class="form-select rounded-0" aria-label="Default select example" name="club"
                                        id="club1">
                                        <option value="" selected>Select Club</option>
                                        @foreach ($clubs as $club)
                                            <option value="{{ $club->id }}">{{ $club->name . '-' . $club->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control rounded-0" name="score" id="score1"
                                        placeholder="score" value="0">
                                </div>
                            </div>
                            <div class="col d-flex flex-row-reverse">
                                <div class="mb-3">
                                    <select class="form-select rounded-0" aria-label="Default select example" name="club"
                                        id="club2">
                                        <option value="" selected>Select Club</option>
                                        @foreach ($clubs as $club)
                                            <option value="{{ $club->id }}">{{ $club->name . '-' . $club->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control rounded-0" name="score" id="score2"
                                        placeholder="score" value="0">
                                </div>
                            </div>
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
