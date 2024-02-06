@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 d-block">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <p>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none" > {{ $post->author->name }} </a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
            @if($post->image)
            <div style="max-height: 350px; overflow:hidden;">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
            </div>
            @else
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="card-img-top mt-4" alt="...">
            @endif

            <article class="my-3 fs-5">
                {!!  $post->body  !!}
            </article>
        
            <a href="/posts" class="mt-3 btn btn-primary">Kembali Ke Posts</a>
        </div>
    </div>
</div>
@endsection