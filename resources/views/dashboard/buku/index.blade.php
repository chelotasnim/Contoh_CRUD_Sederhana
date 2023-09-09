@extends('dashboard.template.master')

@section('dashboard')

    @error('nama')
        <div class="alert-box">{{ $message }}</div>
    @enderror

    @if (session()->has('success'))
        <div class="alert-box success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('buku') }}" class="controller" method="POST">
        @csrf
        <div class="form-group">
            <select name="category_id" placeholder="Pilih Kategori">
                <option selected hidden disabled>Pilih Kategori</option>
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="nama" placeholder="Nama Buku">
        </div>
        <div class="form-group">
            <textarea name="deskripsi" placeholder="Dekripsi Singkat"></textarea>
        </div>
        <button type="submit" class="btn">Tambah</button>
    </form>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>*</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kategori->nama }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ url('buku/' . $item->id) }}" class="badge yellow">Ubah</a>
                            <a href="{{ url('delete_buku/' . $item->id) }}" class="badge red">Hapus</a>
                        </div>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    
@endsection