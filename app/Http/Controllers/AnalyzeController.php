<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AnalyzeController extends Controller
{
    public function index($id)
    {
    $user = User::findOrFail($id);
    // $stulogs = $user->stulogs()->orderBy('log_date')->get();
    // foreach ($stulogs as $stulog) {
    //     $H += $stulog->study_time_array()[H];
    //     $M += $stulog->study_time_array()[M];
    //     $H += intdiv($M, 60);
    //     $M %= 60;
    //     $whole_study_time = $H . ':' . $M;
    //
    //}
    
    return view('analyze.index', [
            'user' => $user,
        ]);
    }
}
    
