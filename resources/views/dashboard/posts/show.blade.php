@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8 d-block">
            <h1 class="mb-4">{{ $post->title }}</h1>

            <a href="/dashboard/posts" class="btn btn-success"><i data-feather="arrow-left"></i> Kembali Ke Daftar Post</a>

            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><i data-feather="edit" style="color:blue"></i></a>

            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Yakin Mau Menghapus?')"><i data-feather="trash-2"></i></button>
            </form>
            @if($post->image)
            <div style="max-height: 350px; overflow:hidden;">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top mt-4" alt="...">
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