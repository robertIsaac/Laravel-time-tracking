<?php

namespace App\Http\Controllers;

use App\Http\Resources\Log as LogResource;
use App\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LogResource::collection(Log::all());
    }
}
