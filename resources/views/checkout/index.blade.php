@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Checkout</h1>

    @if (!empty($cart) && count($cart) > 0)
        <div class="row">
            <!-- Display Cart Items -->
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
                                <p class="card-text mb-1">Harga: <span class="fw-bold">IDR {{ number_format($item['price'], 0, ',', '.') }}</span></p>
                                <p class="card-text mb-1">Jumlah: <span class="fw-bold">{{ $item['quantity'] }}</span></p>
                                <p class="card-text">Total: <span class="fw-bold">IDR {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Display Subtotal -->
            <div class="col-md-12 my-4">
                <h4>Subtotal: <strong class="text-primary">IDR {{ number_format($subtotal, 0, ',', '.') }}</strong></h4>
            </div>

            <!-- Shipping Method Options -->
            <div class="col-md-12">
                <h5 class="mb-3">Pilih Metode Pengiriman</h5>
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
                        <label class="list-group-item d-flex justify-content-between align-items-center mt-2">
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
        <div class="col-md-12 text-center">
            <p class="text-muted">Keranjang Anda kosong.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali ke Halaman Produk</a>
        </div>
    @endif
</div>
@endsection