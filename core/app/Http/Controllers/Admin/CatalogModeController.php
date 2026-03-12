<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogModeController extends Controller
{
    public function unavailable(Request $request)
    {
        $message = 'This admin feature is unavailable in catalogue mode';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'error',
                'message' => $message,
            ], 403);
        }

        $notify[] = ['info', $message];

        return to_route('admin.dashboard')->withNotify($notify);
    }
}
