<?php

namespace App\Http\Controllers;

use App\Models\Matchs;
use App\Models\Clubs;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matchs = Matchs::all();
        $clubs = Clubs::all();

        return view('matchs',['matchs' => $matchs, 'clubs' => $clubs, 'active' => 'matchs']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validated = $request->validate([
            'stadium' => 'nullable',
        ]);

        $createMatch = Matchs::create($validated);

        return redirect('/matchs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matchs  $matchs
     * @return \Illuminate\Http\Response
     */
    public function show(Matchs $matchs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matchs  $matchs
     * @return \Illuminate\Http\Response
     */
    public function edit(Matchs $matchs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matchs  $matchs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matchs $matchs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matchs  $matchs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matchs $matchs)
    {
        //
    }
}
