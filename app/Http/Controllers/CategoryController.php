<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('kategori.index', compact('categories'));
    }

    public function tambah()
    {
        return view('kategori/tambah');
    }

    public function tambahProses(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
        ],
        [
            'name.required' => 'Nama Kategori Harus Diisi',
            'description.required' => 'Deskripsi Kategori Harus Diisi',
        ]);
        // return $request;
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name)
        ]);
        alert()->success('Sukses','Berhasil Ditambahkan');
        return redirect('kategori');
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        // return $categories;
        return view('kategori.edit', compact('categories'));
    }

    public function editProses(Request $request, $id)
    {
        // return $request;

        Category::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name)
        ]);
        alert()->success('Sukses','Berhasil Diedit');
        return redirect('kategori');
    }

    public function hapus($id)
    {
        Category::find($id)->delete();
        alert()->success('Sukses','Berhasil Dihapus');
        return redirect('kategori');

    }

    
}
