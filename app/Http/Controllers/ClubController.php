<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function getData()
    {
        $clubs = Clubs::all();

        return json_encode($clubs);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Clubs::orderBy('point', 'desc')->get();

        return view('clubs',['clubs' => $clubs, 'active' => 'clubs']);
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
        $validated = $request->validate([
            'name' => 'required|unique:clubs',
            'city' => 'required|unique:clubs',
        ]);

        $createClub = Clubs::create($validated);

        return redirect('/clubs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function show(Clubs $clubs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function edit(Clubs $clubs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clubs $clubs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clubs $clubs)
    {
        //
    }
}
