<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetricRecord;
use App\Models\User;
use App\Models\Business;
use Carbon\Carbon;

class FeedsController extends Controller
{
    public function index()
    {
        // Get recent activities for the feeds
        $activities = $this->getRecentActivities();
        
        return view('dashboard-feeds.index', compact('activities'));
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // Get recent metric updates
        $recentMetrics = MetricRecord::with(['metric'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        foreach ($recentMetrics as $record) {
            $activities->push([
                'type' => 'metric_updated',
                'title' => 'Metric Updated',
                'description' => "Metric '{$record->metric->title ?? $record->title}' was updated",
                'user' => 'System User', // In real implementation, get from user relationship
                'branch' => 'Main Office', // In real implementation, get from user's business
                'value' => $record->value,
                'date' => $record->date,
                'created_at' => $record->created_at,
                'icon' => 'bi-graph-up',
                'color' => 'success'
            ]);
        }

        // Get recent user registrations
        $recentUsers = User::with('roles')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        foreach ($recentUsers as $user) {
            $activities->push([
                'type' => 'user_created',
                'title' => 'New Team Member',
                'description' => "{$user->name} joined as {$user->roles->name ?? 'Member'}",
                'user' => $user->name,
                'branch' => $user->company ?? 'Main Office',
                'created_at' => $user->created_at,
                'icon' => 'bi-person-plus',
                'color' => 'info'
            ]);
        }

        // Add some sample milestone activities
        $activities->push([
            'type' => 'milestone',
            'title' => 'Customer Milestone',
            'description' => 'Reached 10,000 customers milestone',
            'user' => 'Marketing Team',
            'branch' => 'Main Office',
            'created_at' => Carbon::now()->subDays(1),
            'icon' => 'bi-trophy',
            'color' => 'warning'
        ]);

        // Sort activities by created_at desc
        return $activities->sortByDesc('created_at')->take(20);
    }

    public function filter(Request $request)
    {
        $activityType = $request->get('activity_type');
        $business = $request->get('business');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // In a real implementation, this would filter the activities based on the parameters
        $activities = $this->getRecentActivities();

        // Apply filters
        if ($activityType && $activityType !== 'all') {
            $activities = $activities->where('type', $activityType);
        }

        if ($business && $business !== 'all') {
            $activities = $activities->where('branch', $business);
        }

        if ($dateFrom && $dateTo) {
            $activities = $activities->whereBetween('created_at', [
                Carbon::parse($dateFrom)->startOfDay(),
                Carbon::parse($dateTo)->endOfDay()
            ]);
        }

        return response()->json([
            'activities' => $activities->values()
        ]);
    }
}