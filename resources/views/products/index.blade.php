@extends('layouts.app')

@section('title', 'Daftar Katalog Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-primary mb-0">Daftar Produk</h3>
        <small class="text-muted">Total data tersimpan di MongoDB: {{ $products->count() }} produk</small>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        + Tambah Produk Baru
    </a>
</div>

@if ($products->isEmpty())
    <div class="card bg-white p-5 text-center shadow-sm">
        <h5 class="text-muted mb-2">Belum ada data produk di database MongoDB</h5>
        <p class="text-secondary mb-3">Silakan tambahkan produk pertama Anda melalui tombol di bawah ini.</p>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk Sekarang</a>
        </div>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($products as $product)
            <div class="col">
                <div class="card h-100 bg-white shadow-sm">
                    @if ($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top product-img" alt="{{ $product->nama_produk }}">
                    @else
                        <div class="product-img d-flex align-items-center justify-content-center text-secondary">
                            <span>Tanpa Gambar</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                {{ $product->kategori }}
                            </span>
                        </div>
                        <h5 class="card-title fw-bold mb-1">{{ $product->nama_produk }}</h5>
                        <p class="text-muted small mb-2" style="font-family: monospace;">
                            ID: {{ $product->_id }}
                        </p>
                        <p class="card-text text-secondary small flex-grow-1">
                            {{ Str::limit($product->deskripsi, 80) }}
                        </p>
                        <div class="border-top pt-2 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </span>
                                <span class="badge {{ $product->stok > 0 ? 'bg-light text-dark border' : 'bg-danger' }}">
                                    Stok: {{ $product->stok }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top-0 pb-3 d-flex gap-2">
                        <a href="{{ route('products.edit', $product->_id) }}" class="btn btn-outline-primary btn-sm w-50">
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product->_id) }}" method="POST" class="w-50" onsubmit="return confirm('Yakin ingin menghapus produk ini dari MongoDB?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection