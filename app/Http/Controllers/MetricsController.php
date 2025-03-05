<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetricsController extends Controller
{
    public function index()
{
    $defaultMetrics = [
    ];

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
            'date' => now()->toDateString(), // You can modify this as needed
            'value' => '0', // Default value, you can modify this as needed
            'change' => '+0', // Default change, you can modify this as needed
            'favorite' => false,
        ];

        $newMetric['actions'] = '
            <div class="action-icons">
                <a href="#" class="edit-icon"><i class="bi bi-pencil"></i></a>
                <form action="' . route('metrics.destroy', count($metrics)) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="delete-icon"><i class="bi bi-trash"></i></button>
                </form>
                <form action="' . route('metrics.toggleFavorite', count($metrics)) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    <button type="submit" class="star-icon ' . ($newMetric['favorite'] ? 'favorite' : '') . '"><i class="bi bi-star"></i></button>
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
