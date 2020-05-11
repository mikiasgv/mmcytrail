<?php

namespace App\Http\Controllers;

use CventClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirstController extends Controller
{
    public function index()
    {
        $cc = new CventClient();
        $account = "MMCYSB001";
        $username = "MMCYSB001Api";
        $password = "StZYkonYV4R";
        $cc->Login($account, $username, $password);
        $events = $cc->GetUpcomingEvents();

        return view('restclients.index', compact('events'));
    }
}
