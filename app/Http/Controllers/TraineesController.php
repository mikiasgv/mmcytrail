<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainee;
use App\Rank;
use App\Record;
use App\Skill;
use App\Badge;
use App\Daily;
use App\Path;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TraineesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $badgerecords = DB::table('records')
            ->join('badges_records', 'records.record_id', '=', 'badges_records.record_id')
            ->join('badges', 'badges_records.badge_id', '=', 'badges.badge_id')
            ->select('records.*', 'badges.badge', 'badges.url')
            ->get();


        $skillrecords = DB::table('records')
            ->join('skills_records', 'records.record_id', '=', 'skills_records.record_id')
            ->join('skills', 'skills_records.skill_id', '=', 'skills.skill_id')
            ->select('records.*', 'skills.skill')
            ->get();


        $data['trainees'] = DB::table('trainees')->get();
        $data['ranks'] = Rank::all();
        $data['paths'] = Path::all();
        $data['records'] = DB::table('records')->select('trainee_Id', 'record_Id', 'rank_Id', 'trails',
                                                            'time_stamp',
                                                            DB::raw('MAX(points) as point'))
                                ->groupBy('record_id','rank_id','trainee_id', 'trails', 'time_stamp')
                                ->orderBy('point', 'desc')
                                ->get();
        $data['latest_records'] = Record::orderBy('trainee_Id', 'asc')
                                        ->orderBy('time_stamp', 'desc')
                                        ->get();

        $data['skills'] = Skill::all();
        $data['badges'] = DB::table('badges')->get();
        $data['badgerecords'] = $badgerecords;
        $data['skillrecords'] = $skillrecords;

        return response()->json(['data' => $data], 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
