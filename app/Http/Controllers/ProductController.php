<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // READ: Menampilkan semua produk dari MongoDB
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    // CREATE (Form): Menampilkan halaman tambah produk
    public function create()
    {
        return view('products.create');
    }

    // CREATE (Store): Validasi dan simpan dokumen baru ke MongoDB
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'kategori'    => 'required|string|max:100',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $validated['harga'] = (int) $validated['harga'];
        $validated['stok'] = (int) $validated['stok'];

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan ke MongoDB.');
    }

    // UPDATE (Form): Menampilkan halaman edit berdasarkan ObjectId
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // UPDATE (Action): Memperbarui dokumen di MongoDB
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'kategori'    => 'required|string|max:100',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
                Storage::disk('public')->delete($product->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $validated['harga'] = (int) $validated['harga'];
        $validated['stok'] = (int) $validated['stok'];

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    // DELETE: Menghapus dokumen dari MongoDB
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus dari database.');
    }
}