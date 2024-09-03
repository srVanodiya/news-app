<?php
// app/Http/Controllers/NewsController.php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $query = $request->input('q', 'tesla');
        $page = $request->input('page', 1);
        $sort = $request->input('sortBy', 'popularity');
        $pageSize = $request->input('pageSize', 10);
        $articles = $this->newsService->fetchArticles($query, $page, $pageSize, $sort);

        return response()->json($articles);
    }
}