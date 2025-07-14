<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiService
{
    protected $baseUrl = 'https://jsonplaceholder.typicode.com';

    public function getPosts($page = 1, $limit = 10)
    {
        $cacheKey = "posts_page_{$page}_limit_{$limit}";

        return Cache::remember($cacheKey, 60, function () use ($page, $limit) {
            $response = Http::get("{$this->baseUrl}/posts");

            if ($response->failed()) {
                throw new \Exception("failed get posts");
            }

            $data = collect($response->json());

            $total = $data->count();
            $paginated = $data->forPage($page, $limit)->values();

            return new LengthAwarePaginator(
                $paginated,
                $total,
                $limit,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        });
    }


    public function getPost($id) {
        $cacheKey = "post_{$id}";

        return Cache::remember($cacheKey, 60, function () use ($id) {
            $response = Http::get("{$this->baseUrl}/posts/{$id}");

            if ($response->failed()) {
                throw new \Exception("Failed to get single post");
            }

            return $response->json();
        });
    }



    public function getPostComments($id) {
        $cacheKey = "post_{$id}_comments";

        return Cache::remember($cacheKey, 60, function () use ($id) {
        $response = Http::get("{$this->baseUrl}/posts/{$id}/comments");

        if ($response->failed()) {
            throw new \Exception("Failed to fetch comments");
        }

        return $response->json();
    });
    }

    public function getUser($id) {
        $cacheKey = "user_{$id}";

        return Cache::remember($cacheKey, 60, function () use ($id) {
             $response = Http::get("{$this->baseUrl}/users/{$id}");

            if ($response->failed()) {
                throw new \Exception("Failed to get users");
            };

            return $response->json();
        });
    }

    public function getUserPosts($userId) {
        return Cache::remember("posts", 60 , function () use ($userId) {
            $response = Http::get("{$this->baseUrl}/posts", [
                "userId" => $userId
            ]);
    
            if ($response->failed()) {
                throw new \Exception("failed to get user posts");
            }
    
            return $response->json();
        });
    }

}
