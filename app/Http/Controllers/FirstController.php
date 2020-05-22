<?php

namespace App\Http\Controllers;

use App\Daily;
use Carbon\Carbon;
use CventClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirstController extends Controller
{
    public function index()
    {
        $recordsWeek = Daily::orderBy('date_on', 'desc')
                            ->get()
                            ->groupBy(function ($val) {
                                return Carbon::parse($val->date_on)->format('W');
                            })->each(function ($collection, $key) {
                                            $collection->sortBy('date_on')
                                            ->groupBy(function ($val) {
                                                $val->date_on = Carbon::parse($val->date_on)->shortEnglishDayOfWeek;
                                                return Carbon::parse($val->date_on)->format('d');
                            });
                        });


        $recordsMonth = Daily::orderBy('date_on', 'desc')
                                ->get()
                                ->groupBy(function ($val) {
                                    // day
                                    //return Carbon::parse($val->date_on)->format('Y-m-d');
                                    //month
                                    //return Carbon::parse($val->date_on)->format('Y-m');
                                    //week
                                    return Carbon::parse($val->date_on)->format('W');
                                });//->groupBy(function ($val) {
                                //     return Carbon::parse($val->date_on)->format('Y-m-d');
                                // });


        dd(json_decode($recordsMonth));

        //return view('restclients.index', compact('recordsMonth'));
    }
}
