<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AnalyzeController extends Controller
{
    public function index($id)
    {
    $user = User::findOrFail($id);
    return view('analyze.index', [
            'user' => $user,
        ]);
    }
}
    
