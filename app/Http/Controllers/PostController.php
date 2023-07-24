<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StoreFormRequest;
use Illuminate\Support\Facades\Request;


class PostController extends Controller
{
     public function index()
     {
          // dd(Request::input('search'));

          $posts = Post::query()
               ->when(Request::input('search'), fn ($q) => $q->search(Request::input('search')))
               ->paginate(10);
               
          $filter = Request::input('search');

          return inertia('Posts/Index', [
               'posts' => $posts,
               'filter' => $filter,
          ]);
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
