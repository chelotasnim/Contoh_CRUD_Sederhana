@extends('dashboard.template.master')

@section('dashboard')

    @error('nama')
        <div class="alert-box">{{ $message }}</div>
    @enderror

    @if (session()->has('success'))
        <div class="alert-box success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('kategori') }}" class="controller" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="nama" placeholder="Nama Kategori">
        </div>
        <button type="submit" class="btn">Tambah</button>
    </form>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>*</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ url('kategori/' . $item->id) }}" class="badge yellow">Ubah</a>
                            <a href="{{ url('delete_kategori/' . $item->id) }}" class="badge red">Hapus</a>
                        </div>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    
@endsection