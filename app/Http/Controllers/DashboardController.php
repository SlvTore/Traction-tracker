<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\BusinessMetric;
use App\Models\BusinessMetricReport;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboards = Business::with('owner')->get();
        return view('dashboard.index', compact('dashboards'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:users,id',
        ]);

        Business::create([
            'name' => $request->name,
            'owner_id' => $request->owner_id,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Dashboard created successfully.');
    }

    public function edit($id)
    {
        $dashboard = Business::findOrFail($id);
        return view('dashboard.edit', compact('dashboard'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $dashboard = Business::findOrFail($id);
        $dashboard->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Dashboard updated successfully.');
    }

    public function destroy($id)
    {
        $dashboard = Business::findOrFail($id);
        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Dashboard deleted successfully.');
    }
}
