<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    /**
     * Display the blog posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.posts', [
            'posts' => Post::posts()
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show', [
            'post' => Post::whereSlug($slug)->firstOrFail()
        ]);
    }


    public function search(Request $request)
    {
        return view('blog.posts', [
            'posts' => Post::search($request->item)->paginate(12)->appends(['item' => $request->item])
        ]);
    }

}
