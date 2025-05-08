@extends('layouts.app')

@section('title', 'Outfitly')

@section('styles')
    <!-- Swiper & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #fce3d9, #f0e4d7);
            font-family: 'Poppins', Arial, sans-serif;
        }

        .container {
            padding: 40px 20px;
        }

        h1 {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 36px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
        }

        .add-btn {
            display: inline-block;
            background-color: rgb(160, 63, 216);
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            margin: 0 auto 30px;
            transition: background-color 0.3s ease;
        }

        .add-btn:hover {
            background-color:rgb(174, 104, 214);
        }

        .swiper {
            padding: 10px 0 30px;
        }

        .product-card {
        background-color: #fff;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: transform 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Tetapkan tinggi minimum yang sama untuk semua kartu produk */

    /* Kartu Produk */
    .product-card {
        background-color: #fff;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: transform 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Ketinggian Tetap untuk Gambar */
    .product-card img {
        max-width: 100%;
        height: 400px; /* Tetapkan tinggi tetap */
        object-fit: cover; /* Pangkas gambar agar sesuai */
        border-radius: 10px;
        margin-bottom: 12px;
    }

    /* Judul Produk */
    .product-card h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 8px 0 5px;
        min-height: 50px; /* Tetapkan tinggi minimum untuk teks judul */
        line-height: 1.25; /* Membatasi jumlah baris */
    }

    /* Harga Produk */
    .product-card p {
        font-size: 16px;
        margin-bottom: 12px;
        color: #333;
        min-height: 24px; /* Tetapkan tinggi minimum untuk harga */
        line-height: 1.5;
    }

    /* Tombol dan Dropdown Pilihan */
    .product-card form {
        margin-top: auto; /* Tempatkan dropdown dan tombol di bawah */
    }

    .product-card select {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
    }

    .product-card button {
        background-color: rgb(160, 63, 216);
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 500;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .product-card button:hover {
        background-color:rgb(174, 104, 214);
    }

        /* Swiper customizations */
        .swiper-button-next, .swiper-button-prev {
            color: #333;
        }

        .swiper-pagination-bullet {
            background-color: #ccc;
        }

        .swiper-pagination-bullet-active {
            background-color:rgb(160, 63, 216);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            .add-btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
@endsection

@section('content')
<div class="container">
    <h1>Outfitly</h1>

    <!-- Tombol "Lihat Keranjang" -->
    <div style="text-align: center;">
        <a href="{{ route('cart.index') }}" class="add-btn">Lihat Keranjang</a>
    </div>

    <!-- Notifikasi sukses -->
    @if(session('success'))
        <div class="alert alert-success text-center mt-3">{{ session('success') }}</div>
    @endif

    <!-- Swiper Carousel -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    <div class="product-card">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                        <h3>{{ $product['name'] }}</h3>
                        <p>Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                        <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                            @csrf
                            <label for="size-{{ $product['id'] }}">Pilih Ukuran:</label>
                            <select id="size-{{ $product['id'] }}" name="size" required>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <button type="submit">
                                <i class="fa fa-shopping-cart me-1"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigasi Swiper -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 24,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 }
        }
    });
</script>
@endsection