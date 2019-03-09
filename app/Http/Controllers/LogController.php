<?php

namespace App\Http\Controllers;

use App\Log;
use App\Team;
use App\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teams = Team::all();
        $users = User::all();
        $team_id = $request->team;
        $user_id = $request->user;
        $logs = Log::where(function ($query) use ($user_id) {
            if ($user_id) {
                $query->where('user_id', '=', $user_id);
            }
        })->whereHas('user', function ($query) use ($team_id) {
            if ($team_id) {
                $query->where('team_id', '=', $team_id);
            }
        })->get();
        return view('log', compact('logs', 'users', 'teams', 'user_id', 'team_id'));
    }
}
