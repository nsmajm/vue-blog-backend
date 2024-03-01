<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailsResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class PostController extends Controller
{
    public function posts(): JsonResponse
    {
        $posts = Post::take(6)->where('featured', 0)->get();

        return response()->json(PostResource::collection($posts));
    }

    public function postDetails($slug): JsonResponse
    {
        if ($slug !== 'recent_post') {
            $post = Post::where('slug', $slug)->first();
            $post->related_post = Post::where('featured', 0)->where('id', '!=', $post->id)->take(3)->get();
            return response()->json(new PostDetailsResource($post));
        }
        $post = Post::where('featured', 0)->take(3)->get();
        return response()->json(PostResource::collection($post));
//

    }

    public function featuredPost(): JsonResponse
    {
        $post = Post::where('featured', 1)->first();
        return response()->json(new PostResource($post));
    }
}
