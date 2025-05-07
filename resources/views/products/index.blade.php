<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Outfitly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #fce3d9, #f0e4d7);
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 30px auto;
            max-width: 1200px;
        }

        h1 {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            position: relative;
            margin-bottom: 20px;
        }

        h1::after {
            content: "";
            display: block;
            width: 120px;
            height: 4px;
            background-color: rgb(255, 0, 200);
            margin: 10px auto;
            border-radius: 2px;
        }

        .add-btn {
            background-color: rgb(216, 102, 172);
            color: #fff;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            display: block;
            width: fit-content;
            margin: 0 auto 30px;
            text-align: center;
        }

        .add-btn:hover {
            background-color: rgb(187, 118, 196);
            color: #fff;
        }

        .swiper {
            padding: 30px 0;
        }

        .swiper-slide {
            height: auto !important;
            display: flex;
            align-items: stretch;
            justify-content: center;
        }

        /* Tombol Navigasi Swiper */
        .swiper-button-next,
        .swiper-button-prev {
            color: rgb(102, 102, 255); /* Warna panah biru */
            font-size: 24px; /* Ukuran panah */
            width: auto; /* Sesuaikan lebar */
            height: auto; /* Sesuaikan tinggi */
            background: none; /* Hapus latar belakang */
            border: none; /* Hapus border */
            transition: transform 0.3s ease, color 0.3s ease; /* Efek transisi */
            z-index: 10; /* Tetap di atas elemen lain */
        }

        /* Posisi tombol prev di luar slider */
        .swiper-button-prev {
            left: -40px; /* Jarak tombol prev ke kiri */
        }

        /* Posisi tombol next di luar slider */
        .swiper-button-next {
            right: -40px; /* Jarak tombol next ke kanan */
        }

        /* Hover efek tombol navigasi */
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            transform: scale(1.2); /* Memperbesar sedikit saat hover */
            color: rgb(51, 51, 204); /* Warna hover biru lebih gelap */
        }

        /* Bullet pagination aktif */
        .swiper-pagination-bullet-active {
            background-color: rgb(187, 118, 196) !important; /* Bullet aktif dengan warna konsisten */
        }

        .product-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            width: 90%;
            position: relative;
            border: 2px solid #f8f9fa;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
            border-color: rgb(187, 118, 196);
        }

        .product-card img {
            height: 180px;
            max-height: 180px;
            width: auto;
            object-fit: contain;
            margin-bottom: 10px;
            border-radius: 10px;
        }

        .product-card h3 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
        }

        .product-card p {
            font-size: 1rem;
            color: #888;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: rgb(216, 102, 172);
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-primary:hover {
            background-color: rgb(187, 118, 196);
        }

        select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Outfitly</h1>

    <!-- Tombol "Lihat Keranjang" -->
    <a href="{{ route('cart.index') }}" class="add-btn">Lihat Keranjang</a>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    <div class="product-card">
                        <!-- Gambar Produk -->
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                        
                        <!-- Nama dan Harga Produk -->
                        <h3>{{ $product['name'] }}</h3>
                        <p>Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                        
                        <!-- Dropdown Pilih Ukuran -->
                        <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                            @csrf
                            <label for="size-{{ $product['id'] }}">Pilih Ukuran:</label>
                            <select id="size-{{ $product['id'] }}" name="size">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            
                            <!-- Tombol Tambah ke Keranjang -->
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- Script Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next", // Tombol next
            prevEl: ".swiper-button-prev", // Tombol prev
        },
        pagination: {
            el: ".swiper-pagination", // Pagination
            clickable: true,
        },
    });
</script>
</body>
</html>