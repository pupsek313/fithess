<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Trainer;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = Cache::remember('admin.stats', now()->addMinutes(5), fn () => [
            'trainers'        => Trainer::count(),
            'active'          => Trainer::where('is_active', true)->count(),
            'specializations' => Specialization::count(),
        ]);

        return view('admin.dashboard', compact('stats'));
    }
}