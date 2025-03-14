<h2>Tambah Produk</h2>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" required>

    <label>Harga:</label>
    <input type="number" name="price" required>

    <label>Gambar:</label>
    <input type="file" name="image">

    <button type="submit">Simpan</button>
</form>
