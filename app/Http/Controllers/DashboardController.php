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
        Carbon::setLocale('fr');
        $totalClients = User::where('role', 'client')->count();
        $totalAgents = User::where('role', 'agent')->count();
        $totalTransactions = Transaction::count();

        $today = Carbon::today();
        $transactionsToday = Transaction::whereDate('date', $today)->count();

        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();

        // Initialize an array to hold the labels (days) and transaction counts
        $labels = [];
        $transactionCounts = [];

        // Loop through each day of the week
        $currentDay = $currentWeekStart;
        while ($currentDay <= $currentWeekEnd) {
            // Get the number of transactions for the current day
            $transactionsCount = Transaction::whereDate('date', $currentDay)->count();

            // Add the label (day) and transaction count to the respective arrays
            $labels[] = $currentDay->format('l'); // 'l' formats the day as the full name (e.g., Monday)
            $transactionCounts[] = $transactionsCount;

            // Move to the next day
            $currentDay->addDay();
        }

        // Fill in missing days with 0 transaction counts
        while (count($labels) < 7) {
            $labels[] = $currentDay->format('l');
            $transactionCounts[] = 0;
            $currentDay->addDay();
        }


        // Get all agents and their commissions
        $agentsCommissions = User::where('role', 'agent')->get();

        // Initialize arrays for labels (noms) and values (montants)
        $labelAgents = [];
        $valuesBalances = [];

        // Loop through each agent and add their name to the labels array
        // and their balance (montant) to the values array
        foreach ($agentsCommissions as $agent) {
            // Access the name of the agent
            $name = $agent->prenom . ' ' . $agent->nom;

            // Access the balance (montant) of the agent
            $balance = $agent->balances[0]->montant;

            // Add the name to the labels array
            $labelAgents[] = $name;

            // Add the balance to the values array
            $valuesBalances[] = $balance;
        }

        return view('welcome', compact('totalClients', 'totalTransactions', 'transactionsToday', 'totalAgents', 'labels', 'transactionCounts', 'labelAgents', 'valuesBalances'));
    }
}
