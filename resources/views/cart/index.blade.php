@extends('layouts.app')

@section('title', 'Outfitly - Keranjang')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold text-dark">Keranjang</h1>

    @if (!empty($cart) && count($cart) > 0)
        @foreach ($cart as $item)
        <div class="card mb-4 shadow-sm border-0">
            <div class="row g-0 align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ asset($item['image']) }}" class="img-fluid rounded-start p-3" alt="{{ $item['name'] }}">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">{{ $item['name'] }}</h5>
                        <p class="mb-1"><strong>Harga:</strong> IDR {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p><strong>Ukuran:</strong> {{ $item['size'] ?? 'Tidak dipilih' }}</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-outline-secondary btn-sm update-cart me-2" 
                                data-id="{{ $item['id'] }}" data-action="decrement">
                            <i class="fa fa-minus"></i>
                        </button>
                        <span class="mx-2 quantity fw-bold" id="quantity-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
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

            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-primary d-flex align-items-center mb-2">
                    <i class="fa fa-arrow-left me-2"></i> Lihat Produk
                </a>

                <div class="d-flex gap-2 flex-wrap">
                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">
                            <i class="fa fa-trash me-2"></i> Kosongkan Keranjang
                        </button>
                    </form>

                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary">
                        <i class="fa fa-shopping-cart me-2"></i> Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fa fa-shopping-cart fa-5x text-muted mb-4"></i>
            <p class="fs-5 text-muted">Keranjang Anda kosong. Yuk, tambahkan produk ke keranjang!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mt-3">
                <i class="fa fa-arrow-left me-2"></i> Lihat Produk
            </a>
        </div>
    @endif
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');

    body, h1, h2, h3, h4, h5, h6, p, span, label {
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary {
        background-color:rgb(209, 89, 169);
        border-color: rgb(209, 89, 169);
        color: white;
        font-weight: 500;
    }

    .btn-danger {
        background-color: #ff52d9;
        border-color: #ff52d9;
        color: white;
        font-weight: 500;
    }

    .btn-primary:hover,
    .btn-danger:hover {
        background-color:rgb(196, 114, 170);
        border-color: rgb(196, 114, 170);
        color: white;
    }

    body {
        background: linear-gradient(135deg, #fce3d9, #f0e4d7);
    }

    .card-title {
        color: #333;
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

        document.querySelectorAll('.update-cart').forEach(button => {
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
