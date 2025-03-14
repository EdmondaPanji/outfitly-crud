<h2>Edit Produk</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Nama:</label>
    <input type="text" name="name" value="{{ $product->name }}" required>

    <label>Harga:</label>
    <input type="number" name="price" value="{{ $product->price }}" required>

    <label>Gambar Baru (jika ingin ganti):</label>
    <input type="file" name="image">

    @if ($product->image)
        <p>Gambar Lama:</p>
        <img src="{{ asset('images/' . $product->image) }}" width="150">
    @endif

    <button type="submit">Update</button>
</form>
