@extends('layouts.app')

@section('title', 'Outfitly - Keranjang')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Keranjang</h1>

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

            <!-- Diperbarui: Tombol kiri dan kanan -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                <!-- Tombol kiri -->
                <a href="{{ route('products.index') }}" class="btn btn-primary d-flex align-items-center mb-2">
                    <i class="fa fa-arrow-left me-2"></i> Lihat Produk
                </a>

                <!-- Tombol kanan -->
                <div class="d-flex gap-2 flex-wrap">
                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger d-flex align-items-center"
                                onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">
                            <i class="fa fa-trash me-2"></i> Kosongkan Keranjang
                        </button>
                    </form>

                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary d-flex align-items-center">
                        <i class="fa fa-shopping-cart me-2"></i> Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <div class="empty-cart-icon mb-4">
                <i class="fa fa-shopping-cart fa-5x text-muted"></i>
            </div>
            <p class="text-muted fs-5 mb-4">Keranjang Anda kosong. Yuk, tambahkan produk ke keranjang!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="fa fa-arrow-left me-2"></i> Lihat Produk
            </a>
        </div>
    @endif
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;700&display=swap');

h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', Arial, sans-serif;
    font-weight: 700;
}

body, p, span, label {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
}

h4 {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    color: #000;
}

.btn-primary, .btn-danger {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-danger {
    background-color: rgb(255, 82, 217);
    border-color: rgb(255, 82, 217);
    color: white;
}

.btn-primary {
    background-color: rgb(204, 109, 172);
    border-color: rgb(204, 109, 172);
    color: white;
}

.btn-danger:hover, .btn-primary:hover {
    background-color: #c279ab;
    border-color: #c279ab;
    color: white;
}

body {
    background: linear-gradient(135deg, #fce3d9, #f0e4d7);
    margin: 0;
    padding: 0;
}
</style>

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
