<?php

// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class PageController extends Controller
{
    // Display page A
    public function pageA()
    {
		// Log the "page-a" action
		ActivityLog::create([
			'user_id' => auth()->id(),
			'action' => 'page-a',
			'description' => 'Go to page A',
		]);

        return view('page-a');
    }

    // Handle cow purchase
    // app/Http/Controllers/PageController.php

	public function buyCow(Request $request)
	{
		// Log the "buy_cow" action
		ActivityLog::create([
			'user_id' => auth()->id(),
			'action' => 'buy_cow',
			'description' => 'User bought a cow',
		]);

		// Return JSON response
		return response()->json([
			'success' => true,
			'message' => 'Cow purchased! Thank you!',
		]);
	}


    // Display page B
    public function pageB()
    {
		// Log the "page-b" action
		ActivityLog::create([
			'user_id' => auth()->id(),
			'action' => 'page-b',
			'description' => 'Go to page B',
		]);

        return view('page-b');
    }

    // Handle file download
    public function download()
    {

		// Log the "download" action
		ActivityLog::create([
			'user_id' => auth()->id(),
			'action' => 'download',
			'description' => 'User downloaded a file',
		]);

        // Specify the file path for download
        $filePath = public_path('downloads/file.exe'); // Replace with the actual file path

        return response()->download($filePath);
    }
}
