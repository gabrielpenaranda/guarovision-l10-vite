<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        return view('admin.log.index');
    }

    public function show(Log $log)
    {
        return view('admin.log.show', compact('log'));
    }
}
