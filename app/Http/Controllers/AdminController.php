<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use App\Models\User;

class AdminController extends Controller
{
    // app/Http/Controllers/AdminController.php

	public function statistics(Request $request)
	{
		// Retrieve the list of all users for filtering
		$users = User::all();

		// Get filters from the request
		$startDate = $request->input('start_date');
		$endDate = $request->input('end_date');
		$userId = $request->input('user_id');
		$action = $request->input('action');

		// Build query to filter data
		$query = ActivityLog::query();

		if ($startDate) {
			$query->whereDate('created_at', '>=', $startDate);
		}

		if ($endDate) {
			$query->whereDate('created_at', '<=', $endDate);
		}

		if ($userId) {
			$query->where('user_id', $userId);
		}

		if ($action) {
			$query->where('action', $action);
		}

		// Retrieve the filtered activity data
		$activities = $query->with('user')->get();

		return view('admin.statistics', compact('activities', 'users'));
	}


	// app/Http/Controllers/AdminController.php

	public function reports()
	{
		// Retrieve data from the last 30 days and group by date and action
		$reportData = ActivityLog::selectRaw('DATE(created_at) as date, action, COUNT(*) as count')
								->where('created_at', '>=', now()->subDays(30))
								->groupBy('date', 'action')
								->orderBy('date')
								->get();

		// Format data for JavaScript
		$reportDataFormatted = [];

		foreach ($reportData as $data) {
			$date = $data->date;
			$action = $data->action;
			$count = $data->count;

			if (!isset($reportDataFormatted[$date])) {
				$reportDataFormatted[$date] = [
					'view_page_a' => 0,
					'view_page_b' => 0,
					'buy_cow' => 0,
					'download' => 0,
				];
			}

			$reportDataFormatted[$date][$action] = $count;
		}

		// Pass the processed data to the view
		return view('admin.reports', [
			'reportData' => $reportDataFormatted
		]);
	}

}

// app/Http/Controllers/AdminController.php
