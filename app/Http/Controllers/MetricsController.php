<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetricsController extends Controller
{
    public function index()
    {
        $metrics = [
            ['Metric 1', '2025-02-26', 'Up', '100', '+10', '<button class="btn btn-primary">Action</button>'],
            ['Metric 2', '2025-02-25', 'Down', '90', '-5', '<button class="btn btn-primary">Action</button>'],
            ['Metric 3', '2025-02-24', 'Up', '110', '+15', '<button class="btn btn-primary">Action</button>'],
            ['Metric 4', '2025-02-23', 'Down', '80', '-20', '<button class="btn btn-primary">Action</button>'],
            ['Metric 5', '2025-02-22', 'Up', '120', '+25', '<button class="btn btn-primary">Action</button>']
        ];

        return view('dashboard-metrics.index', compact('metrics'));
    }

    public function create()
    {
        return view('dashboard-metrics.create');
    }
}
