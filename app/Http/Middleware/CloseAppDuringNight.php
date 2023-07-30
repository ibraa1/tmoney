<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CloseAppDuringNight
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role == 'superAdmin') {
            return $next($request);
        }

        $currentTime = Carbon::now();
        $startNightTime = Carbon::createFromTime(22, 0, 0);
        $endNightTime = Carbon::createFromTime(8, 0, 0);

        // Vérifier si l'heure actuelle est après 22h OU avant 8h
        if ($currentTime->gte($startNightTime) || $currentTime->lt($endNightTime)) {
            return response()->view('close'); // Redirige vers une page statique
        }
        return $next($request);
    }
}
