<?php

namespace App\Http\Controllers;

use App\Models\ClubMatchs;
use App\Models\Matchs;
use App\Models\Clubs;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClubMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubMatchs = DB::select(
            DB::raw(
                "SELECT allMatch.club_id, club.name as clubName, club.city as clubCity, club.point as clubPoint, count(*) as totalMatch, winMatch.totalWin as totalWin, winMatch.totalGolWin as totalGolWin, loseMatch.totalLose as totalLose, loseMatch.totalGolLose as totalGolLose, drawMatch.totalDraw as totalDraw
                FROM club_matchs as allMatch
                LEFT JOIN clubs as club ON allMatch.club_id = club.id
                LEFT JOIN (SELECT club_id, count(*) as totalWin, sum(gol) as totalGolWin FROM club_matchs GROUP BY result, club_id HAVING result='win') AS winMatch ON allMatch.club_id = winMatch.club_id
                LEFT JOIN (SELECT club_id, count(*) as totalLose, sum(gol) as totalGolLose FROM club_matchs GROUP BY result, club_id HAVING result='lose') AS loseMatch ON allMatch.club_id = loseMatch.club_id
                LEFT JOIN (SELECT club_id, count(*) as totalDraw FROM club_matchs GROUP BY result, club_id HAVING result='draw') AS drawMatch ON allMatch.club_id = drawMatch.club_id
                GROUP BY allMatch.club_id
                ORDER BY club.point DESC"
            )
        );

        return view('clubMatchs', ['clubMatchs' => collect($clubMatchs), 'active' => 'home']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->data as $clubs) {
            // check if match exist
            $clubMatchs = DB::select(
                DB::raw(
                    'SELECT A.club_id AS club_id1, B.club_id AS club_id2
                    FROM club_matchs A
                    INNER JOIN club_matchs B ON A.match_id = B.match_id AND A.club_id < B.club_id'
                )
            );

            foreach ($clubMatchs as $clubMatch) {
                $clubMatchCollection = collect($clubMatch);
                $matchExist = [];
                $clubExist = '';

                foreach ($clubs as $club) {
                    if ($clubMatchCollection->contains($club['club'])) {
                        array_push($matchExist, true);
                        $clubExist .= $club['name'].' ';
                    } else {
                        array_push($matchExist, false);
                        $clubExist .= $club['name'].' ';
                    }
                }

                if (in_array(false, $matchExist) === false) {
                    return response(ucwords($clubExist."'s match already exist"), 400)->header('Content-Type', 'text/plain');
                }
            }

            // match result
            $winScore = 0;
            $winner = '';
            foreach ($clubs as $club) {
                if ($winScore === $club['score']) {
                    $winScore = $club['score'];
                    $winner = '';
                } else if ($winScore < $club['score']) {
                    $winScore = $club['score'];
                    $winner = $club['score'];
                }
            }

            // create club match
            $createMatch = Matchs::create();
            foreach ($clubs as $club) {
                $createClubMatch = ClubMatchs::create([
                    "match_id" => $createMatch->id,
                    "club_id" => $club['club'],
                    "gol" => $club['score'],
                    "result" => $winner === '' ? 'draw' : ($winner === $club['club'] ? 'win' : 'lose')
                ]);

                $point = $winner === '' ? 1 : ($winner === $club['club'] ? 3 : 0);
                $updateClubScore = Clubs::find($club['club'])->increment('point', $point);
            }
        }

        return response('Match Successfully Created', 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClubMatch  $clubMatch
     * @return \Illuminate\Http\Response
     */
    public function show(ClubMatch $clubMatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClubMatch  $clubMatch
     * @return \Illuminate\Http\Response
     */
    public function edit(ClubMatch $clubMatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClubMatch  $clubMatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClubMatch $clubMatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClubMatch  $clubMatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClubMatch $clubMatch)
    {
        //
    }
}
