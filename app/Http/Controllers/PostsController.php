<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request) {
        dd($request);
    }

    public function show(Request $request, Post $post) {
        dd($post);
    }
}
