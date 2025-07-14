<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\ApiService;

class PostController extends Controller
{
    protected $api;

    public function __construct(ApiService $api) {
        $this->api = $api;
    }

    public function index(Request $request) {
        $page = $request->get('page', 1);
        $limit = 10;

        $search = $request->get('search');
        $userId = $request->get('userId');
        $postId = $request->get('postId');

        try {
            $posts = $this->api->getPosts($page, $limit);

            $filtered = collect($posts->items());

            if ($search) {
                $filtered = $filtered->filter(function ($post) use ($search) {
                    return str_contains(strtolower($post['title']), strtolower($search)) ||
                       str_contains(strtolower($post['body']), strtolower($search));
                });
            }

            if($userId) {
                $filtered = $filtered->where('userId', $userId);
            }

            if($postId) {
                $filtered = $filtered->where('id', $postId);
            }

            $total = $filtered->count();
            $paginated = new LengthAwarePaginator(
                $filtered->forPage($page, $limit)->values(),
                $total,
                $limit,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

        } catch (\Exception $e) {
            return view('posts.index', ['error' => $e->getMessage()]);
        }

        return view('posts.index', [
            "posts" => $paginated,
            "total" => $total,
            "page" => $page,
            "limit" => $limit,
            "search" => $search,
            "userId" => $userId,
            "postId" => $postId,
        ]);
    }

    public function show($id) {
        try {
            $post = $this->api->getPost($id);
            $comment = $this->api->getPostComments($id);
        } catch (\Exception $e) {
            return view('posts.show', ["error" => $e->getMessage()]);
        }
        return view("posts.show", [
            "post" => $post,
            "comments" => $comment
        ]);
    }

    public function create() {
        return view('posts.form', ['post' => null]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'userId' => 'required|numeric'
        ]);

        $response = Http::post('https://jsonplaceholder.typicode.com/posts', $data);

        if($response->failed()) {
            return back()->withError(['message' => 'Failed to create Post']);
        }

        return redirect()->route('posts.index')->with('success', 'Post Successly Created');
    }

    public function edit($id) {
        $post = $this->api->getPost($id);

        return view('posts.form', ['post' => $post]);
    }

    public function update (Request $request, $id) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        $response = Http::put("https://jsonplaceholder.typicode.com/posts/{$id}", $data);

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Failed to update post']);
        };

        return redirect()->route('posts.show', $id)->with('success', 'Post Successly Updated');
    }

   public function load(Request $request) {
    $page = $request->get('page', 1);
    $limit = 10;

    $search = $request->get('search');
    $userId = $request->get('userId');
    $postId = $request->get('postId');

    try {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        if ($response->failed()) {
            throw new \Exception("failed to load data");
        }

        $data = collect($response->json());

        if ($search) {
            $data = $data->filter(function ($post) use ($search) {
                return str_contains(strtolower($post['title']), strtolower($search)) ||
                       str_contains(strtolower($post['body']), strtolower($search));
            });
        }

        if ($userId) {
            $data = $data->where('userId', $userId);
        }

        if ($postId) {
            $data = $data->where('id', $postId); 
        }

        $total = $data->count();
        $paginated = $data->forPage($page, $limit)->values();

        return response()->json([
            "data" => $paginated,
            "total" => $total,
            "page" => $page,
            "limit" => $limit
        ]);

    } catch (\Exception $e) {
        return response()->json([
            "error" => $e->getMessage()
        ], 500);
    }
}

    public function favorites() {
    return view('posts.favorites');
}



}
