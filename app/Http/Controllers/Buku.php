<?php

namespace App\Http\Controllers;

use App\Models\Buku as ModelsBuku;
use App\Models\Kategori as ModelsKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Buku extends Controller
{
    public function index()
    {
        $data = array(
            'page' => 'buku',
            'kategori' => ModelsKategori::get(),
            'buku' => ModelsBuku::with('kategori')->get()
        );
        return view('dashboard.buku.index', $data);
    }

    public function add_buku()
    {
        $validator = Validator::make(request()->all(), [
            'category_id' => 'required',
            'nama' => 'required|max:100|unique:bukus,nama',
            'deskripsi' => 'required'
        ], [
            'category_id.required' => 'Wajib Menentukan Kategori Buku',
            'nama.required' => 'Nama Buku Wajib Diisi',
            'nama.max' => 'Nama Buku Maksimal 50 Karakter',
            'nama.unique' => 'Nama Buku Tidak Boleh Sama',
            'deskripsi.required' => 'Wajib Mengisi Deskripsi Buku'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        };

        ModelsBuku::create([
            'category_id' => request()->input('category_id'),
            'nama' => request()->input('nama'),
            'deskripsi' => request()->input('deskripsi')
        ]);

        return redirect('buku')->with('success', 'Buku Baru Ditambahkan');
    }

    public function edit_buku($id)
    {
        $data = array(
            'page' => 'buku',
            'kategori' => ModelsKategori::get(),
            'buku_ini' => ModelsBuku::with('kategori')->where('id', $id)->first(),
            'buku' => ModelsBuku::with('kategori')->get()
        );

        return view('dashboard.buku.edit', $data);
    }

    public function update_buku($id)
    {
        $validator = Validator::make(request()->all(), [
            'category_id' => 'required',
            'nama' => 'required|max:100',
            'deskripsi' => 'required'
        ], [
            'category_id.required' => 'Wajib Menentukan Kategori Buku',
            'nama.required' => 'Nama Buku Wajib Diisi',
            'nama.max' => 'Nama Buku Maksimal 50 Karakter',
            'nama.unique' => 'Nama Buku Tidak Boleh Sama',
            'deskripsi.required' => 'Wajib Mengisi Deskripsi Buku'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        };

        $old_data = ModelsBuku::where('id', $id)->first();
        if (request()->input('nama') == $old_data->nama) {
            ModelsBuku::where('id', $id)->update([
                'category_id' => request()->input('category_id'),
                'deskripsi' => request()->input('deskripsi')
            ]);

            return redirect('buku')->with('success', 'Data Buku Berhasil Dirubah');
        } else {
            $validator2 = Validator::make(request()->all(), [
                'nama' => 'unique:bukus,nama'
            ]);

            if ($validator2->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            };

            ModelsBuku::where('id', $id)->update([
                'nama' => request()->input('nama'),
                'category_id' => request()->input('category_id'),
                'deskripsi' => request()->input('deskripsi')
            ]);

            return redirect('buku')->with('success', 'Data Buku Berhasil Dirubah');
        };
    }

    public function delete_buku($id)
    {
        ModelsBuku::where('id', $id)->delete();
        return redirect('buku')->with('success', 'Buku Berhasil Dihapus');
    }
}
