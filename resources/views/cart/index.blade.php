@extends('layouts.app')

@section('content')
<div class="container">
    <h1>KERANJANG</h1>
    <div class="row">
        @if (!empty($cart) && count($cart) > 0)
            @foreach ($cart as $item)
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset($item['image']) }}" class="card-img" alt="{{ $item['name'] }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['name'] }}</h5>
                                <p class="card-text">Harga: IDR {{ number_format($item['price'], 0, ',', '.') }}</p>
                                <p class="card-text">Ukuran: {{ $item['size'] ?? 'Tidak dipilih' }}</p> <!-- Menampilkan ukuran -->
                                <div class="d-flex align-items-center">
                                    <!-- Tombol pengaturan jumlah -->
                                    <button class="btn btn-outline-secondary btn-sm update-cart" 
                                            data-id="{{ $item['id'] }}" data-action="decrement">-</button>
                                    <span class="mx-2 quantity" id="quantity-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                    <button class="btn btn-outline-secondary btn-sm update-cart" 
                                            data-id="{{ $item['id'] }}" data-action="increment">+</button>

                                    <!-- Tombol hapus -->
                                    <form method="POST" action="{{ route('cart.remove', $item['id']) }}" class="d-inline ms-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Menampilkan subtotal -->
            <div class="col-md-12 text-right">
                <h4>Subtotal: <strong id="subtotal">IDR {{ number_format($subtotal, 0, ',', '.') }}</strong></h4>
                <form method="POST" action="{{ route('cart.clear') }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-2" 
                            onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</button>
                </form>
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-sm mt-2">Checkout</a>
            </div>
        @else
            <!-- Jika keranjang kosong -->
            <div class="col-md-12">
                <p class="text-center">Keranjang Anda kosong.</p>
                <div class="text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Lihat Produk</a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Tambahkan Script untuk Mengatur Tombol -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateCart = async (id, action) => {
            try {
                const response = await fetch(`/cart/update/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        quantityChange: action === 'increment' ? 1 : -1
                    })
                });

                if (!response.ok) throw new Error('Gagal memperbarui keranjang');

                const data = await response.json();

                // Update tampilan jumlah dan subtotal
                document.getElementById(`quantity-${id}`).textContent = data.newQuantity;
                document.getElementById('subtotal').textContent = `IDR ${data.newSubtotal.toLocaleString('id-ID')}`;
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui keranjang. Coba lagi.');
            }
        };

        const buttons = document.querySelectorAll('.update-cart');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const action = this.dataset.action;

                // Nonaktifkan tombol sementara
                button.disabled = true;

                updateCart(id, action).finally(() => {
                    button.disabled = false; // Aktifkan kembali tombol
                });
            });
        });
    });
</script>
@endsection