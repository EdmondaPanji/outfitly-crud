<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Outfitly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f0e4d7;
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 30px auto;
            max-width: 1200px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .add-btn {
            background-color: #28a745;
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
            background-color: #218838;
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

        .product-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 15px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            width: 90%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
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
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .swiper-pagination-bullet-active {
            background-color: #007bff !important;
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
                        
                        <!-- Tombol Tambah ke Keranjang -->
                        <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm w-100">Tambah ke Keranjang</button>
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