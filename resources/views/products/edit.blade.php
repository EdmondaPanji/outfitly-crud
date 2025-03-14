<form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Nama Produk">
    <input type="number" name="price" placeholder="Harga">
    <input type="file" name="image">
    <button type="submit">Simpan</button>
</form>
