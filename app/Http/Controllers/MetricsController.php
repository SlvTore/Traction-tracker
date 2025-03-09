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
                'change' => '+0',
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
        $metric = Metric::findOrFail($id);
        return view('dashboard-metrics.edit', compact('metric'));
    }

    public function update(Request $request, $id)
    {
        $metric = Metric::findOrFail($id);
        $metric->update([
            'value' => $request->input('value', $metric->value),
            'status' => $request->input('status', $metric->status),
            'notes' => $request->input('notes', $metric->notes),
        ]);

        return redirect()->route('metrics')->with('success', 'Metric updated successfully.');
    }

    public function destroy($id)
    {
        $metric = Metric::findOrFail($id);
        $metric->delete();

        return redirect()->route('metrics');
    }
}
