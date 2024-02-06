<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);
    
        if($request->file('image'))
        {
            $validated['image'] = $request->file('image')->store('post-images');
        }

        $slug = Str::slug($validated['title']);
        $uniqueSlug = Post::where('slug', $slug)->exists();
        if ($uniqueSlug) {
            $slug .= '-' . uniqid();
        }
    
        $validated['slug'] = $slug;
        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 200);
    
        Post::create($validated);
    
        return redirect('/dashboard/posts')->with('success', 'Berhasil!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];


        if($request->slug != $post->slug)
        {
            $rules['slug'] = 'required|unique:posts';
        }

        $validated = $request->validate($rules);
        if($request->file('image'))
        {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('post-images');
        }
        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)
            ->update($validated);

        return redirect('/dashboard/posts')->with('success', 'Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
    
        return redirect('/dashboard/posts')->with('success', 'Berhasil Menghapus!');
    }

    // public function slug(Request $request)
    // {
    //     $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
    //     return response()->json(['slug' => $slug]);
    // }
}
