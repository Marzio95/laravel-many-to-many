<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function myindex(Request $request)
    {
        $users = User::all();
        $categories = Category::all();
        $posts = Post::where('user_id', Auth::user()->id)->paginate(20);
        return view('admin.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'users' => $users,
            'request' => $request,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::whereRaw('1 = 1');

        if ($request->s) {
            $posts->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', "%$request->s%")
                    ->orWhere('content', 'LIKE', "%$request->s%");
            });
        }

        if ($request->category) {
            $posts->where('category_id', $request->category);
        }

        if ($request->author) {
            $posts->where('user_id', $request->author);
        }

        $posts = $posts->paginate(20);

        $categories = Category::all();
        $users = User::all();

        // $posts = Post::paginate(20);
        return view('admin.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'users' => $users,
            'request' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:20',
            'postText' => 'required|max:500',
            'slug' => 'required',
            'category_id' => 'required|exists:App\Category,id',
            'tags' => 'exists:App\Tag,id'
        ]);

        $formData = $request->all() + ['user_id' => Auth::user()->id];
        $post = Post::create($formData);
        $post->tags()->attach($formData['tags']);
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', [
            'pageTitle' => $post->title,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id === $post->user_id) {
            $categories = Category::all();
            $tags = Tag::all();
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:20',
            'postText' => 'max:500',
            'slug' => ['required', Rule::unique('posts')->ignore($post)],
        ]);

        $formData = $request->all();
        $post->update($formData);
        $post->tags()->sync($formData['tags']);
        return redirect()->route('admin.posts.show', $post->slug);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();
        $post->delete();

        if (url()->previous() === route('admin.posts.edit', $post->slug)) {
            return redirect()->route('admin.posts.index')->with('status', "Post $post->title deleted");
        }
        if (url()->previous() === route('admin.posts.show', $post->slug)) {
            return redirect()->route('admin.posts.index')->with('status', "Post $post->title deleted");
        }
        return redirect(url()->previous())->with('status', "Post $post->title deleted");
    }
}
