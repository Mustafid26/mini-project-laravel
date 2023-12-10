@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang, {{ auth()->user()->name }}</h1>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="card bg-success text-white">
                    <div class="card-header text-white">Jumlah Postingan Anda</div>
                    <div class="card-body">
                        <p class="card-text fs-2">{{ $count }} Postingan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection