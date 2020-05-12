<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Daily;
use App\Trainee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProgressController extends Controller
{
    public function index()
    {
        $data = [];

        $records = Daily::orderBy('date_on')
                        ->get()
                        ->groupBy(function ($val) {
                            return Carbon::parse($val->date_on)->format('d');
                        });

        $recordsWeek = Daily::orderBy('date_on')
                        ->get()
                        ->groupBy(function ($val) {
                            return Carbon::parse($val->date_on)->format('W');
                        });

        $recordsMonth = Daily::orderBy('date_on')
                        ->get()
                        ->groupBy(function ($val) {
                            return Carbon::parse($val->date_on)->format('Y-m');
                        });

        $todayRecord = Daily::whereDay('date_on', Carbon::now()->format('d'))
                            ->get();

        $userCount = Trainee::all()->count();


        $data['userscount'] = $userCount;
        $data['records'] = $records;
        $data['todayRecord'] = $todayRecord;
        $data['recordsWeek'] = $recordsWeek;
        $data['recordsMonth'] = $recordsMonth;

        return response()->json(['data' => $data], 200);

    }
}
