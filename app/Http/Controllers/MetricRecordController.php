<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetricRecord;
use App\Models\Metric;

class MetricRecordController extends Controller
{
    public function getRecords($metricId)
    {
        $records = MetricRecord::where('metric_id', $metricId)->get();
        return response()->json(['data' => $records]);
    }

    public function store(Request $request, $metricId)
    {
        $metric = Metric::findOrFail($metricId);

        MetricRecord::create([
            'metric_id' => $metric->id,
            'title' => $request->input('title'),
            'date' => $request->input('date'), // Pastikan kolom date ada di sini
            'value' => $request->input('value'),
            'status' => $request->input('status'),
            'notes' => $request->input('notes'),
        ]);

        return response()->json(['success' => 'Metric record created successfully.']);
    }

    public function update(Request $request, $id)
    {
        $record = MetricRecord::findOrFail($id);

        $record->update([
            'title' => $request->input('title'),
            'date' => $request->input('date'), // Pastikan kolom date ada di sini
            'value' => $request->input('value'),
            'status' => $request->input('status'),
            'notes' => $request->input('notes'),
        ]);

        return response()->json(['success' => 'Metric record updated successfully.']);
    }

    public function destroy($id)
    {
        $record = MetricRecord::findOrFail($id);
        $record->delete();

        return response()->json(['success' => 'Metric record deleted successfully.']);
    }
}
