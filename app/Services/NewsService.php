<?php
// app/Services/NewsService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsService
{
    public function fetchArticles($query , $page ,$pageSize, $sortBy )
    {
        $apiKey = config('services.newsapi.key');
        $response = Http::withOptions(['verify' => false])->get('https://newsapi.org/v2/everything', [
            'q' => $query,
            'sortBy' => $sortBy,
            'apiKey' => $apiKey,
            'page' => $page,
            'pageSize' => $pageSize,
            
        ]);
       return $response->json();
    }
}