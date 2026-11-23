@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card bg-white shadow-sm">
            <div class="card-header bg-primary text-white fw-bold py-3">
                Edit Produk (ID: {{ $product->_id }})
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label fw-semibold">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori', $product->kategori) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $product->harga) }}" min="0" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label fw-semibold">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $product->stok) }}" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $product->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="form-label fw-semibold">Ganti Gambar Produk (Opsional)</label>
                        @if ($product->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Preview" class="rounded border" style="height: 90px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        <div class="form-text">Kosongkan jika tidak ingin mengganti gambar saat ini.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Perbarui Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection