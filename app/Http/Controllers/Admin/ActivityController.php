<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function activities()
    {
        $activities = $this->getLatestActivityItems();

        return response()->json($activities);
    }


    /**
     * Get all activity for admin dashboard.
     *
     * @return Collection
     */
    public function getLatestActivityItems(): Collection
    {
        return Activity::with('causer')
            ->latest()
            ->limit(30)
            ->get();
    }
}
