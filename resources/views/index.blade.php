<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OUTFITLY</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>OUTFITLY</h1>
    <a href="{{ route('products.create') }}">Tambah Produk</a>
    <div class="catalog">
        @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <a href="{{ route('products.edit', $product->id) }}">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
        @endforeach
    </div>
</body>
</html>
