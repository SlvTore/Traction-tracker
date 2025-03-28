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
        // Mendapatkan semua metrics yang sudah ada untuk perbandingan
        $existingMetrics = Metric::pluck('title')->toArray();
        return view('dashboard-metrics.create', compact('existingMetrics'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'selected_metrics' => 'required|array',
            'selected_metrics.*' => 'string'
        ]);

        $selectedMetrics = $request->input('selected_metrics', []);
        $createdCount = 0;

        // Log untuk debugging
        \Log::info('Creating metrics with data:', ['selected_metrics' => $selectedMetrics]);

        foreach ($selectedMetrics as $metricTitle) {
            try {
                Metric::create([
                    'title' => $metricTitle,
                    'date' => now()->toDateString(),
                    'value' => '0',
                    'trend' => 'neutral',
                    'change' => '+0',
                    'status' => 'warning',
                    'notes' => '',
                    'change_percentage' => 0,
                    'created_id' => auth()->id() ?? null
                ]);
                $createdCount++;
            } catch (\Exception $e) {
                \Log::error('Failed to create metric: ' . $e->getMessage());
            }
        }

        if ($createdCount > 0) {
            return redirect()->route('metrics')->with('success', $createdCount . ' metrics berhasil ditambahkan');
        } else {
            return redirect()->route('metrics')->with('error', 'Gagal menambahkan metrics');
        }
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
