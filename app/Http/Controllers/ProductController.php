<?php

namespace App\Http\Controllers;

use Str;
use Alert;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function kategori()
    {
        $kategori = Category::all();
        return view('produk.kategori', compact('kategori'));
    }

    public function index(Category $category)
    {
        $produk = Product::where('category_id', $category->id)->get();
        return view('produk.index', compact('produk', 'category'));
    }

    public function tambah(Category $category)
    {
        return view('produk/tambah', compact('category'));
    }

    public function prosesTambah(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required',
        ],
        [
            'name.required' => 'Produk Harus Diisi',
            'price.required' => 'Harga Harus Diisi',
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price
        ]);

        alert()->success('Sukses','Berhasil Ditambahkan');
        return redirect()->route('produk.index', $category);
    }

    public function edit(Category $category, Product $product)
    {
        return view('produk/edit', compact('category', 'product'));
    }

    public function editProses(Request $request, Category $category, Product $product)
    {
        // return $request;
        $product->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        alert()->success('Sukses','Berhasil Diedit');
        return redirect()->route('produk.index', $category);
    }

    public function hapus(Category $category, Product $product)
    {
        $product->delete();
        alert()->success('Sukses','Berhasil Dihapus');
        return redirect()->route('produk.index', $category);
    }
}
