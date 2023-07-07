<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = User::where('role', 'client')->count();
        $totalAgents = User::where('role', 'agent')->count();
        $totalTransactions = Transaction::count();

        $today = Carbon::today();
        $transactionsToday = Transaction::whereDate('date', $today)->count();

        return view('welcome', compact('totalClients', 'totalTransactions', 'transactionsToday', 'totalAgents'));
    }
}
