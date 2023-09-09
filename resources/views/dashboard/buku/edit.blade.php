@extends('dashboard.template.master')

@section('dashboard')

    @error('nama')
        <div class="alert-box">{{ $message }}</div>
    @enderror

    @if (session()->has('success'))
        <div class="alert-box success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('buku/' . $buku_ini->id) }}" class="controller" method="POST">
        @csrf
        <div class="form-group">
            <select name="category_id" placeholder="Pilih Kategori" value="{{ $buku_ini->category_id }}">
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="nama" placeholder="Nama Buku" value="{{ $buku_ini->nama }}">
        </div>
        <div class="form-group">
            <textarea name="deskripsi" placeholder="Dekripsi Singkat">{{ $buku_ini->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn">Ubah</button>
        <a href="{{ url('kategori') }}" class="btn secondary">Batal</a>
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
                @if ($item->id == $buku_ini->id)
                <tr class="stripped">
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
                @else
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
                @endif
               @endforeach
            </tbody>
        </table>
    </div>
    
@endsection