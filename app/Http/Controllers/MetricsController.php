<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Metric;

class MetricsController extends Controller
{
    public function index()
    {
        $metrics = Metric::all(); // Ambil semua data dari database
        return view('dashboard-metrics.index', compact('metrics'));
    }

    public function create()
    {
        return view('dashboard-metrics.create');
    }


    public function store(Request $request)
    {
        $selectedMetrics = $request->input('selected_metrics', []);
        $metrics = session()->get('metrics', []);

        foreach ($selectedMetrics as $metricTitle) {
            Metric::create([
                'title' => $metricTitle,
                'date' => now()->toDateString(),
                'value' => '0',
                'change_percentage' => '+0',
                'favorite' => false,
                'status' => 'warning',
                'notes' => '',
            ]);
        }

        session()->put('metrics', $metrics);

        return redirect()->route('metrics');
    }
    public function toggleFavorite($id)
    {
        $metric = Metric::findOrFail($id);
        $metric->update(['favorite' => !$metric->favorite]);

        return redirect()->route('metrics');
    }

    public function edit($id)
    {
        \Log::info('Editing metric with ID: ' . $id);
        try {
            $metric = Metric::findOrFail($id);
            return view('dashboard-metrics.edit', compact('metric'));
        } catch (\Exception $e) {
            \Log::error('Error finding metric: ' . $e->getMessage());
            return redirect()->route('metrics')->with('error', 'Metric not found');
        }
    }

    // app/Http/Controllers/MetricsController.php
    public function update(Request $request, $id)
    {
        $metric = Metric::findOrFail($id);

        // Hanya update kolom edited_value, status, dan notes
        $metric->update([
            'edited_value' => $request->input('value'), // Simpan nilai yang diedit ke kolom terpisah
            'status' => $request->input('status', $metric->status),
            'notes' => $request->input('notes', $metric->notes),
        ]);

        return redirect()->route('metrics')->with('success', 'Metric record updated successfully.');
    }

    public function destroy($id)
    {
        \Log::info('Deleting metric with ID: ' . $id);
        try {
            $metric = Metric::findOrFail($id);
            $metric->delete();
            return redirect()->route('metrics')->with('success', 'Metric deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error deleting metric: ' . $e->getMessage());
            return redirect()->route('metrics')->with('error', 'Failed to delete metric');
        }
    }
    public function visual($id)
    {
        $metric = Metric::findOrFail($id);
        return view('dashboard-metrics.visual', compact('metric'));
    }
}
