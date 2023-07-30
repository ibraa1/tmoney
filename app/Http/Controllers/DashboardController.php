<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


        // Get the start and end dates of the current week
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();

        // Initialize an array to hold the labels (days) and agent balances for each day
        $labelAgents = [];
        $agentBalancesByDay = [];

        // Loop through each day of the week
        $currentDay = $currentWeekStart;
        while ($currentDay <= $currentWeekEnd) {
            // Get the balances for each agent for the current day
            $agentBalances = [];
            $agentsCommissions = User::where('role', 'agent')->get();
            foreach ($agentsCommissions as $agent) {
                // Get the name of the agent
                $name = $agent->prenom . ' ' . $agent->nom;

                // Get the balance of the agent for the current day
                $balance = $agent->balances()
                    ->whereDate('created_at', $currentDay)
                    ->latest()
                    ->first();

                // If the agent has a balance for the current day, store it, otherwise set it to 0
                if ($balance) {
                    $agentBalances[$name] = $balance->montant;
                } else {
                    $agentBalances[$name] = 0;
                }
            }

            // Add the day label to the labels array
            $labelAgents[] = $currentDay->format('l');

            // Add the balances for the current day to the agentBalancesByDay array
            $agentBalancesByDay[] = $agentBalances;

            // Move to the next day
            $currentDay->addDay();
        }

        $apexChartData = [];

        // Loop through each day of the week
        for ($i = 0; $i < 7; $i++) {
            // Get the balances for each agent for the current day
            $agentBalances = $agentBalancesByDay[$i];

            // Loop through each agent's balances and add them to the formatted data
            foreach ($agentBalances as $agentName => $balance) {
                // Check if the agent's data already exists in the formatted data array
                if (isset($apexChartData[$agentName])) {
                    // Agent's data already exists, add the balance to the existing data
                    $apexChartData[$agentName]['data'][] = $balance;
                } else {
                    // Agent's data does not exist, create a new data entry for the agent
                    $apexChartData[$agentName] = [
                        'name' => $agentName,
                        'data' => [$balance],
                    ];
                }
            }
        }

        // dd($apexChartData);


        return view('welcome', compact('totalClients', 'totalTransactions', 'transactionsToday', 'totalAgents', 'labels', 'transactionCounts', 'labelAgents', 'apexChartData'));
    }
}
