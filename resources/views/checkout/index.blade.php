@extends('layouts.app')

@section('title', 'Outfitly - Checkout')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Checkout</h1>

    @if (!empty($cart) && count($cart) > 0)
        <!-- Display Cart Items -->
        @foreach ($cart as $item)
        <div class="card mb-4 shadow-sm border-0">
            <div class="row g-0 align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ asset($item['image']) }}" class="img-fluid rounded-start p-3" alt="{{ $item['name'] }}">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ $item['name'] }}</h5>
                        <p class="card-text mb-2"><strong>Harga:</strong> IDR {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p class="card-text mb-2"><strong>Jumlah:</strong> {{ $item['quantity'] }}</p>
                        <p class="card-text"><strong>Total:</strong> IDR {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Display Subtotal -->
        <div class="card my-4 shadow-sm border-0">
            <div class="card-body">
                <h4 class="text-end">Subtotal: <strong class="text-primary">IDR {{ number_format($subtotal, 0, ',', '.') }}</strong></h4>
            </div>
        </div>

        <!-- Shipping Method Options -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-4">Pilih Metode Pengiriman</h5>
                <form method="POST" action="{{ route('cart.completeCheckout') }}">
                    @csrf
                    <div class="list-group">
                        <!-- Home Delivery Option -->
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <input type="radio" name="shipping_method" value="home_delivery" required>
                                <strong>Kirim ke Alamat</strong>
                                <p class="mb-0 text-muted">Dapatkan potongan ongkir IDR 10.000 minimum pembelian IDR 150.000 ke seluruh Indonesia</p>
                            </div>
                            <span class="text-primary fw-bold">IDR 10.000</span>
                        </label>

                        <!-- Store Pickup Option -->
                        <label class="list-group-item d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <input type="radio" name="shipping_method" value="store_pickup" required>
                                <strong>Ambil di Toko</strong>
                                <p class="mb-0 text-muted">Gratis biaya pengiriman untuk pick up di toko terdekat</p>
                            </div>
                            <span class="text-primary fw-bold">Gratis</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg mt-4 w-100">Selesaikan Checkout</button>
                </form>
            </div>
        </div>
    @else
        <!-- Empty Cart Message -->
        <div class="text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="fa fa-shopping-cart fa-5x text-muted"></i>
            </div>
            <p class="text-muted fs-5">Keranjang Anda kosong. Yuk, tambahkan produk ke keranjang!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="fa fa-arrow-left"></i> Kembali ke Halaman Produk
            </a>
        </div>
    @endif
</div>

<style>
/* Import Fonts */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;700&display=swap');

/* Heading Font */
h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', Arial, sans-serif;
    font-weight: 700;
    color: #333;
}

/* Body Font */
body, p, span, label {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    color: #555;
}

/* Subtotal and Important Text */
.text-primary {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    color: #d81b60; /* Pink gelap */
}

/* Button Styling */
.btn-primary {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    background-color: #f48fb1; /* Warna pink */
    border-color: #f48fb1;
    color: #fff;
}

.btn-primary:hover {
    background-color: #ec407a; /* Pink lebih gelap */
    border-color: #ec407a;
}

/* Background */
body {
    background: linear-gradient(135deg, #fce3d9, #f0e4d7);
    margin: 0;
    padding: 0;
}
</style>
@endsection
