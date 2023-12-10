<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostController extends Controller

{
    public function index(){
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' Kategori ' . $category->name;
        }
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = '  Dibuat Oleh ' . $author->name;
        }
        return view('posts',[
            'title' => 'Semua Post ' . $title,
            'active' => "post",
            'posts' => Post::latest()->search(request(['search', 'category', 'author']))->paginate(10)->withQueryString()
        ]);
    }

    public function authors(User $user)
    {
        return view('posts',[
            'title' => 'User Posts',
            'active' => "post",
            'posts' => $user->posts,
        ]);
    }

    public function show(Post $post){
        return view('post',[
            'title' => "Blog",
            'active' => "post",
            'post' => $post
        ]);
    }
}
