<!DOCTYPE html>
<html>
<head>
    <title>Katalog Produk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Katalog Produk</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}">Tambah Produk</a>

    <table border="1">
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>

        @foreach ($products as $product)
        <tr>
            <td>
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" width="100">
                @else
                    Tidak Ada Gambar
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>Rp {{ number_format($product->price) }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
