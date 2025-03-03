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
                $metricTitle,
                now()->toDateString(),
                'Up', // You can modify this as needed
                '0', // Default value, you can modify this as needed
                '+0', // Default change, you can modify this as needed
                '<div class="btn-group" role="group" aria-label="Action Buttons">
                <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                <form action="' . route('metrics.destroy', count($metrics)) . '" method="POST">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> </button>
                </form>
                <button type="button" class="btn btn-warning"><i class="bi bi-star"></i></button>
            </div> '
            ];
            $metrics[] = $newMetric;
        }

        session()->put('metrics', $metrics);

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
