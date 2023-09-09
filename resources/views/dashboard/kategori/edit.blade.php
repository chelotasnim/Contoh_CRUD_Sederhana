@extends('dashboard.template.master')

@section('dashboard')

    @error('nama')
        <div class="alert-box">{{ $message }}</div>
    @enderror

    @if (session()->has('success'))
        <div class="alert-box success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('kategori/' . $kategori_ini->id) }}" class="controller" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="nama" placeholder="Nama Kategori" value="{{ $kategori_ini->nama }}">
        </div>
        <button type="submit" class="btn">Ubah</button>
        <a href="{{ url('kategori') }}" class="btn secondary">Batal</a>
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
                @if ($item->id == $kategori_ini->id)
                <tr class="stripped">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ url('kategori/' . $item->id) }}" class="badge yellow">Ubah</a>
                            <a href="{{ url('delete_kategori/' . $item->id) }}" class="badge red">Hapus</a>
                        </div>
                    </td>
                </tr>
                @else
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
                @endif
               @endforeach
            </tbody>
        </table>
    </div>
    
@endsection