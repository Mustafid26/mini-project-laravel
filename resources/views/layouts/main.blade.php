<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>KaisaBlog! | {{ $title }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary d-flex">
        <div class="container mb-lg-0">
          <a class="navbar-brand" href="#">
            <span class="fs-4 fw-bold">Kaisa</span><span class="text-primary fs-4 fw-bold">Blog!</span>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link {{ ($active === "home") ? 'active' : ' ' }}" aria-current="page"  href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($active === "about") ? 'active' : ' ' }}"  href="/about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($active === 'post') ? 'active' : ' ' }}"  href="/posts">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($active === 'kategori') ? 'active' : ' ' }}"  href="/categories">Categories</a>
              </li>
            </ul>
          </div>

          <ul class="navbar nav me-auto mb-2 mb-lg-0"> 
          @auth
          <li class="nav item dropdown">
            <a class="nav-link dropdown-toggle"  style="color:black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu text-center">
              <li><a class="dropdown-item disabled" href="#">{{ auth()->user()->name }}</a></li>
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window"></i> DashboardKu</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </form>
              </li>
            </ul>
          </li>
          @else
          <li class="navbar-nav">
            <a
              class="nav-link"
              href="/login"
            >
              <i class="fa-solid fa-right-to-bracket {{ ($active === 'login') ? 'active' : ' ' }}"></i> Login
            </a>
          </li>
          @endauth
          </ul>

        </div>
    </nav>
    <div class="container mt-4">
      @yield('container')
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>