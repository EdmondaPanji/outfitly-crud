@extends('layouts.app')

@section('title', 'Outfitly - Keranjang')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">KERANJANG</h1>

    @if (!empty($cart) && count($cart) > 0)
        @foreach ($cart as $item)
        <div class="card mb-3 shadow-sm">
            <div class="row g-0 align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ asset($item['image']) }}" class="img-fluid rounded-start p-3" alt="{{ $item['name'] }}">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <p class="card-text mb-1"><strong>Harga:</strong> IDR {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Ukuran:</strong> {{ $item['size'] ?? 'Tidak dipilih' }}</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-outline-secondary btn-sm update-cart me-2" 
                                data-id="{{ $item['id'] }}" data-action="decrement">
                            <i class="fa fa-minus"></i>
                        </button>
                        <span class="mx-2 quantity" id="quantity-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                        <button class="btn btn-outline-secondary btn-sm update-cart ms-2" 
                                data-id="{{ $item['id'] }}" data-action="increment">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('cart.remove', $item['id']) }}" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        <div class="text-end mt-4">
            <h4>Subtotal: <strong id="subtotal">IDR {{ number_format($subtotal, 0, ',', '.') }}</strong></h4>
            <form method="POST" action="{{ route('cart.clear') }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm mt-3" 
                        onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">
                    <i class="fa fa-trash"></i> Kosongkan Keranjang
                </button>
            </form>
            <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-sm mt-3">
                <i class="fa fa-shopping-cart"></i> Checkout
            </a>
        </div>
    @else
        <div class="text-center">
            <div class="empty-cart-icon mb-4">
                <i class="fa fa-shopping-cart fa-5x text-muted"></i>
            </div>
            <p class="text-muted fs-5 mb-4">Keranjang Anda kosong. Yuk, tambahkan produk ke keranjang!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="fa fa-arrow-left"></i> Lihat Produk
            </a>
        </div>
    @endif
</div>

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

                button.disabled = true;

                updateCart(id, action).finally(() => {
                    button.disabled = false;
                });
            });
        });
    });
</script>
@endsection