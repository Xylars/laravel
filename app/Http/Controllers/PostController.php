<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'tag'])
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view("main.posts.view-posts", compact("posts"));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view("main.posts.create-post", compact("tags", "categories"));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $post = Post::create([
            "title" => $data["title"],
            "content" => $data["content"],
            'user_id' => auth()->id(),
        ]);
        if (!empty($data['categories'])) {
            $post->category()->attach($data['categories']);
        }
        if (!empty($data['tags'])) {
            $post->tag()->attach($data['tags']);
        }

        return redirect()->route('posts.index')->with('success', 'Created Article Succesfully!');
    }
    public function show(Post $post)
    {
        return view('main.posts.view-post', compact('post'));
    }
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->back();
        }
        $tags = Tag::all();
        $categories = Category::all();
        $post->load('tag', 'category');
        return view('main.posts.edit-post', compact('post', 'categories', 'tags'));

    }
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->back();
        }
        $data = $request->validated();
        $post->update([
            "title" => $data["title"],
            "content" => $data["content"],
        ]);
        if (!empty($data['categories'])) {
            $post->category()->sync($data['categories']);
        } else {
            $post->category()->sync([]);
        }
        if (!empty($data['tags'])) {
            $post->tag()->sync($data['tags']);
        } else {
            $post->tag()->sync([]);

        }
        $redirect = $request->input('redirect_to', route('posts.index'));
        return redirect($redirect)->with('success', 'Article updated successfully!');
    }
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Deleted Post Successfully!');
    }

}
