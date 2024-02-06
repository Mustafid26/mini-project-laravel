<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthorController extends Controller
{
    public function index(User $author){
        return view('posts',[
            'title' => "Nama Author : $author->name",
            'active' => "post",
            'posts' => $author->posts->load('category', 'author'),
        ]);
    }
}
