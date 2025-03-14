@extends('layouts.app')

@section('content')
    <h1>Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nama Produk</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Harga</label>
            <input type="number" name="price" required>
        </div>
        <div>
            <label>Gambar Produk</label>
            <input type="file" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <a href="{{ route('products.index') }}">← Kembali</a>
@endsection
