<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Outfitly</title>

    <!-- Bootstrap CSS (opsional buat button biar rapih) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0e4d7; /* Coklat muda */
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .product-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .swiper {
            padding: 30px 0;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #333;
        }

        .add-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .add-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Outfitly</h1>

    <!-- Tombol Aksi -->
    <div class="mb-4">
        <a href="{{ route('cart.index') }}" class="add-btn me-2" style="background-color: green;">Lihat Keranjang</a>
        <a href="{{ route('products.create') }}" class="add-btn">Tambah Produk</a>
    </div>

    <!-- Slider Product -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="d-flex justify-content-center gap-2 mb-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm w-100">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigasi Panah -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination Bulat -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Swiper Config -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            }
        });
    </script>

</body>
</html>
