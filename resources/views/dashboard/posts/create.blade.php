@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Postingan Baru</h1>
</div>

<div class="col-lg-8">
    <form action="/dashboard/posts" method="post" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" nameclass="form-label">Judul</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Web Programming" required value="{{ old('title') }}">
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid" @enderror id="slug" name="slug" placeholder="web-programming" required value="{{ old('slug') }}">
          @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
                @foreach ($categories as $category)
                @if(old('category_id') == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Input Gambar</label>
          <img src="" class="img-fluid img-preview mb-3 col-sm-5" alt="">

          <input class="form-control  @error('image') is-invalid  @enderror" type="file" id="image" name="image" onchange="previewImage()">

          @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Body</label>
            @error('body')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
  document.addEventListener("trix-file-accept", (e)=>{
    e.preventDefault();
  })
</script>
<script>

  function previewImage(){
    const image = document.querySelector('#image');
    const imgpre = document.querySelector('.img-preview');

    imgpre.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent){
      imgpre.src = oFREvent.target.result;
    }
  }


</script>
{{-- <script>
    const title = document.querySelector('#title')
    const slug = document.querySelector('#slug')

    title.addEventListener('change', function(){
        fetch('/dashboard/posts/slug?title=' + (title.value))
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script> --}}
@endsection