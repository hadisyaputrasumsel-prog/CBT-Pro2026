<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Participant;

class AdminController extends Controller
{
    public function index()
    {
        $participants = Participant::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('participants'));
    }
}
