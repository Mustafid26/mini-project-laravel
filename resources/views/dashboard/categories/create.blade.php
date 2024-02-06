@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Kategori Baru</h1>
</div>

<div class="col-lg-8">
    <form action="/dashboard/categories" method="post" class="mb-5">
        @csrf
        <div class="mb-3">
          <label for="name" nameclass="form-label">Nama Kategori</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Web Programming" required value="{{ old('name') }}">
          @error('name')
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
{{-- <script>
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