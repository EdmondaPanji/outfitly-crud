<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Outfitly</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 30px;
        }

        h1 {
            margin-bottom: 20px;
            font-weight: bold;
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

        .swiper {
            width: 100%;
            padding-top: 20px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .product-card h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .product-card p {
            font-weight: bold;
            color: #333;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .swiper-button-next, .swiper-button-prev {
            color: #000;
        }
    </style>
</head>
<body>

    <h1 style="font-family: 'Poppins', sans-serif; font-weight:700;">Outfitly</h1>

    <div class="mb-4">
        <a href="{{ route('cart.index') }}" class="btn btn-success me-2">Lihat Keranjang</a>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    <!-- Swiper Slider Start -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

                        <h3>{{ $product->name }}</h3>
                        <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="actions">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm w-100">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigasi -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
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
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            }
        });
    </script>

</body>
</html>
