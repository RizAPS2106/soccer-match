@extends('layouts.index')

@section('content')
    <h1>Ranks</h1>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Club</th>
                <th scope="col">City</th>
                <th scope="col">Match</th>
                <th scope="col">Win</th>
                <th scope="col">Draw</th>
                <th scope="col">Lose</th>
                <th scope="col">Win Goal</th>
                <th scope="col">Lose Goal</th>
                <th scope="col">Point</th>
            </tr>
        </thead>
        <tbody>
            @if ($clubMatchs->isEmpty())
                <tr>
                    <td colspan="10">No Data Found</td>
                </tr>
            @else
                @foreach ($clubMatchs as $clubMatch)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $clubMatch->clubName }}</td>
                        <td>{{ $clubMatch->clubCity }}</td>
                        <td>{{ $clubMatch->totalMatch == null ? 0 : $clubMatch->totalMatch }}</td>
                        <td>{{ $clubMatch->totalWin == null ? 0 : $clubMatch->totalWin }}</td>
                        <td>{{ $clubMatch->totalDraw == null ? 0 : $clubMatch->totalDraw }}</td>
                        <td>{{ $clubMatch->totalLose == null ? 0 : $clubMatch->totalLose }}</td>
                        <td>{{ $clubMatch->totalGolWin == null ? 0 : $clubMatch->totalGolWin }}</td>
                        <td>{{ $clubMatch->totalGolLose == null ? 0 : $clubMatch->totalGolLose }}</td>
                        <td>{{ $clubMatch->clubPoint == null ? 0 : $clubMatch->clubPoint }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
