<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Batch;
use App\Models\Banner;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class BatchapiController extends Controller
{
    public function index()
    {

        $batches = Batch::where('status', 1)
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
        
        if ($batch->isEmpty()) {
            return response()->json([
                'message' => 'Batches Not Found',
            ], 404);
        } else {
            return response()->json([
                'data' => $batch,
                'message' => 'Batches data retrieved successfully',
            ], 200);
        }
    }

    public function get_banner()
    {

        $banner = Banner::where('status', 1)
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
        
        if ($banner->isEmpty()) {
            return response()->json([
                'message' => 'Batches Not Found',
            ], 404);
        } else {
            return response()->json([
                'data' => $banner,
                'message' => 'Batches data retrieved successfully',
            ], 200);
        }
    }
}
