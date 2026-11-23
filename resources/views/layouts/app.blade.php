<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog Produk')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            color: #1e293b;
        }
        .navbar-custom {
            background-color: #0d6efd;
        }
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }
        .product-img {
            height: 190px;
            object-fit: cover;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">
                Katalog Produk
            </a>
            <div class="ms-auto">
                <a href="{{ route('products.create') }}" class="btn btn-light text-primary fw-semibold btn-sm">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </nav>

    <main class="container mb-5">
        @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>