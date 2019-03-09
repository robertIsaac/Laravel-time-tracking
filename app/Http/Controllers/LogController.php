<?php

namespace App\Http\Controllers;

use App\Log;
use App\Team;
use App\User;
use Carbon\Carbon;
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
        $year = $request->year;
        $week = $request->week;
        $day = $request->day;
        $current = $request->current;
        if (!empty($current)) {
            $year = '';
            $week = '';
            $day = '';
        }
        $logs = Log::where(function ($query) use ($user_id, $year, $week, $day, $current) {
            if ($user_id) {
                $query->where('user_id', '=', $user_id);
            }
//            dd($current);
            if (!empty($current)) {
                switch ($current) {
                    case 'week':
                        $date = new Carbon();
                        $query->whereBetween('created_at', [$date->startOfWeek()->toDateString(), $date->endOfWeek()->toDateString()]);
                        break;
                    case 'month':
                        $date = new Carbon();
                        $query->whereBetween('created_at', [$date->startOfMonth()->toDateString(), $date->endOfMonth()->toDateString()]);
                        break;
                    case '3-months':
                        $date = new Carbon();
                        $to = $date->endOfMonth()->toDateString();
                        $from = $date->addMonths(-2)->startOfMonth()->toDateString();
                        $query->whereBetween('created_at', [$from, $to]);
                        break;
                }
            } elseif (!empty($year) && empty($week)) {
                $query->whereYear('created_at', $year);
            } elseif (!empty($year) && !empty($week) && empty($day)) {
                $date = new Carbon();
                $date->setISODate($year, $week);
                $query->whereBetween('created_at', [$date->startOfWeek()->toDateString(), $date->endOfWeek()->toDateString()]);
            } elseif (!empty($year) && !empty($week) && !empty($day)) {
                $date = new Carbon();
                $date->setISODate($year, $week, $day);
                $query->whereDate('created_at', $date->toDateString());
            }
        })->whereHas('user', function ($query) use ($team_id) {
            if ($team_id) {
                $query->where('team_id', '=', $team_id);
            }
        })->orderBy('created_at')->get();
        return view('log', compact('logs', 'users', 'teams', 'user_id', 'team_id', 'year', 'week', 'day', 'current'));
    }
}
