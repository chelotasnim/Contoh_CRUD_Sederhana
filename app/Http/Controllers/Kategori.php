<?php

namespace App\Http\Controllers;

use App\Models\Kategori as ModelsKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Kategori extends Controller
{
    public function index()
    {
        $data = array(
            'page' => 'kategori',
            'kategori' => ModelsKategori::get()
        );
        return view('dashboard.kategori.index', $data);
    }

    public function add_kategori()
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|max:50|unique:kategoris,nama'
        ], [
            'nama.required' => 'Nama Kategori Wajib Diisi',
            'nama.max' => 'Nama Kategori Maksimal 50 Karakter',
            'nama.unique' => 'Nama Kategori Tidak Boleh Sama'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        };

        ModelsKategori::create([
            'nama' => request()->input('nama')
        ]);

        return redirect('kategori')->with('success', 'Kategori Baru Ditambahkan');
    }

    public function edit_kategori($id)
    {
        $data = array(
            'page' => 'kategori',
            'kategori_ini' => ModelsKategori::where('id', $id)->first(),
            'kategori' => ModelsKategori::get()
        );

        return view('dashboard.kategori.edit', $data);
    }

    public function update_kategori($id)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|max:50|unique:kategoris,nama'
        ], [
            'nama.required' => 'Nama Kategori Wajib Diisi',
            'nama.max' => 'Nama Kategori Maksimal 50 Karakter',
            'nama.unique' => 'Nama Kategori Tidak Boleh Sama'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        };

        ModelsKategori::where('id', $id)->update([
            'nama' => request()->input('nama')
        ]);

        return redirect('kategori')->with('success', 'Kategori Berhasil Dirubah');
    }

    public function delete_kategori($id)
    {
        ModelsKategori::where('id', $id)->delete();
        return redirect('kategori')->with('success', 'Kategori Berhasil Dihapus');
    }
}
