<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetricsController extends Controller
{
    public function index()
    {
        $defaultMetrics = [];

        $metrics = session()->get('metrics', $defaultMetrics);

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
        $newMetric = [
            'title' => $metricTitle,
            'date' => now()->toDateString(),
            'value' => '0',
            'change' => '+0',
            'favorite' => false,
            'status' => 'warning', // Default status
            'notes' => '',
        ];

        $newMetric['actions'] = '
            <div class="btn-group" role="group" aria-label="Metric Actions">
                <a href="' . route('metrics.edit', count($metrics)) . '" class="btn btn-outline-primary">
                    <button type="button" class="btn btn-outline-primary">
                        Record
                    </button>
                </a>
                <form action="' . route('metrics.destroy', count($metrics)) . '" method="POST" >
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
                <form action="' . route('metrics.toggleFavorite', count($metrics)) . '" method="POST">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-outline-warning ' . ($newMetric['favorite'] ? 'active' : '') . '">
                        <i class="bi bi-star"></i>
                    </button>
                </form>
            </div>';

        $metrics[] = $newMetric;
    }

    session()->put('metrics', $metrics);

    return redirect()->route('metrics');
}
    public function toggleFavorite($index)
    {
        $metrics = session()->get('metrics', []);
        if (isset($metrics[$index])) {
            // Toggle the favorite status
            $metrics[$index]['favorite'] = !($metrics[$index]['favorite'] ?? false);
            session()->put('metrics', $metrics);
        }

        return redirect()->route('metrics');
    }

    public function edit($index)
    {
        $metrics = session()->get('metrics', []);
        if (!isset($metrics[$index])) {
            return redirect()->route('metrics')->with('error', 'Metric not found.');
        }

        $metric = $metrics[$index];
        return view('dashboard-metrics.edit', compact('metric', 'index'));
    }

    public function update(Request $request, $index)
    {
        $metrics = session()->get('metrics', []);
        if (!isset($metrics[$index])) {
            return redirect()->route('metrics')->with('error', 'Metric not found.');
        }

        $metrics[$index]['value'] = $request->input('value', $metrics[$index]['value']);
        session()->put('metrics', $metrics);

        return redirect()->route('metrics')->with('success', 'Metric updated successfully.');
    }

    public function destroy($index)
    {
        $metrics = session()->get('metrics', []);
        if (isset($metrics[$index])) {
            unset($metrics[$index]);
            session()->put('metrics', array_values($metrics)); // Reindex array
        }

        return redirect()->route('metrics');
    }
}
