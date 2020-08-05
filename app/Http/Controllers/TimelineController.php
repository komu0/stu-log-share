<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stulog;

class TimelineController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $user->loadRelationshipCounts();
        $stulogs = $user->feed_stulogs()->orderBy('log_date', 'desc')->orderBy('updated_at', 'desc')->paginate(10);
        
        return view('timeline.index', [
            'stulogs' => $stulogs,
            'user' => $user,
        ]);
    }
}
