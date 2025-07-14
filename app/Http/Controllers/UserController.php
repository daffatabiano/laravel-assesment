<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class UserController extends Controller
{
    protected $api;

    public function __construct(ApiService $api) {
        $this->api = $api;
    }

    public function show($id) {
        try {
            $user = $this->api->getUser($id);
            $posts = $this->api->getUserPosts($id);
        } catch (\Exception $e){
            return view('users.show', ['error' => $e.getMessage()]);
        }

        return view('users.show', compact('user', 'posts'));
    }
}
