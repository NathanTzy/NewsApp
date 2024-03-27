<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;

class FrontEndController extends Controller
{
    public function index()
    {

        try {
            // get carrousel from news
            $news = News::latest()->limit(3)->get();

            return ResponseFormatter::success(
                $news,
                'Data carrousel berhasil diambil'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
}
