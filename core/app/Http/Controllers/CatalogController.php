<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function unavailable(Request $request)
    {
        $message = 'This feature is unavailable in catalogue mode';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'error',
                'message' => $message,
            ], 403);
        }

        $notify[] = ['info', $message];

        if ($request->user()) {
            return to_route('user.home')->withNotify($notify);
        }

        return to_route('home')->withNotify($notify);
    }
}
