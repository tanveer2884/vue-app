<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Models\Post;

class PostController extends Controller
{
   public function index()
   {
        $posts = Post::all();
        return inertia('Posts/Index', compact('posts'));
   }

   public function create()
   {
        return inertia('Posts/create');
   }

   public function store(StoreFormRequest $request)
   {
        Post::create($request->validated());

        return redirect()->route('posts.index')
            ->with('message', 'Post created successfully');
   }

   public function edit(Post $post)
   {
        
        $post = Post::findOrFail($post->id);

        return inertia('Posts/Edit', compact('post'));
   }

    public function update(Post $post, StoreFormRequest $request)
    {
        $post->update($request->validated());

        return redirect()->route('posts.index')
            ->with('message', 'Post update successfully');
    }

   public function destroy(Post $post)
   {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('message', 'Post delete successfully');
   }

}
