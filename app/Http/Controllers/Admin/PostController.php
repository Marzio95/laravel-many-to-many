<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function myindex()
    {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $posts = Post::where('title', 'LIKE', "%$request->s%")
                        ->where('category_id', $request->category)
                        ->where('user_id', $request->author)
                        ->paginate(20);

        $categories = Category::all();
        $users = User::all();

        $posts = Post::paginate(20);
        return view('admin.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'users' => $users,
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
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:20',
            'postText' => 'required|max:500',
            'slug' => 'required',
            'category_id' => 'required|exists:App\Category,id',
        ]);

        $formData = $request->all() + ['user_id' => Auth::user()->id];
        $newPost = Post::create($formData);
        return redirect()->route('admin.posts.show', $newPost->slug);
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
            return view('admin.posts.edit', compact('post'));
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

        $post->delete();

        if (url()->previous() === route('admin.posts.edit', $post->slug)) {
            return redirect()->route('admin.home')->with('status', "Post $post->title deleted");
        }
        if (url()->previous() === route('admin.posts.show', $post->slug)) {
            return redirect()->route('admin.home')->with('status', "Post $post->title deleted");
        }
        return redirect(url()->previous())->with('status', 'Profile updated!');
    }
}
