@extends('layouts.main')

@section('container')
    <h1 class="text-center">{{ $title }}</h1>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts" method="get">
                @if (request ('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request ('author'))
                <input type="hidden" name="category" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if($posts->count())
    <div class="card mb-3">
        @if($posts[0]->image)
        <div style="max-height: 350px; overflow:hidden;">
            <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top" alt="...">
        </div>
        @else
        <img src="https://source.unsplash.com/500x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="...">
        @endif
        <div class="card-body text-center">
          <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-black">{{ $posts[0]->title }}</a></h3>
          <p>
            <small class="text-body-secondary">
                <div class="container d-flex justify-content-center">
                    Dibuat Oleh <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> 
                </div>
                    Kategori <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>
            </small>
        </p>

          <p class="card-text">{{ $posts[0]->excerpt }}</p>
          <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary text-decoration-none mb-2">Read More</a>
          <p class="card-text"><small class="text-body-secondary">{{ $posts[0]->created_at->diffForHumans() }}</small></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0,0,0,0.7)">
                        <a href="/posts?category=   {{ $post->category->slug }}" class="text-decoration-none text-white">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    @if($post->image)     
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
                    @else
                    <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2"><a href="/posts/{{ $post->slug }}" class="text-decoration-none text-black">{{ $post->title }}</a></h5>
                        <p class="mb-2">
                        Dibuat Oleh <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> 
                        </p>
                        <p class="mb-4">
                            {{  $post->excerpt  }}
                        </p>
                        <a href="/posts/{{ $post->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
    <p class="text-center fs-4">Postingan Tidak Ada</p>
    @endif

    <div class="container d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
    {{-- @foreach($posts->skip(1) as $post)
    <article class="mb-5 border-bottom pb-4">
        <h2>
            <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-black">{{ $post->title }}</a>
        </h2>

        <p>
            Dibuat Oleh <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> 
            
            Kategori <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>
        </p>

        <p>
            {{  $post->excerpt  }}
        </p>

        <a href="/posts/{{ $post->slug }}" class="text-decoration-none">Read More..</a>
    </article>
    @endforeach --}}
@endsection