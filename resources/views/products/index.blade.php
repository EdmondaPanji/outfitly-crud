<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Outfitly - Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        body {
            background-color: #f0e4d7;
            font-family: Arial, sans-serif;
        }
        h1 {
            margin-bottom: 20px;
        }

        .swiper {
            padding: 30px 0;
        }

        .swiper-slide {
            height: auto !important;
            display: flex;
            align-items: stretch;
        }

        .product-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            width: 100%;
        }

        .product-card img {
            height: 180px;
            max-height: 180px;
            width: auto;
            object-fit: contain;
            margin-bottom: 10px;
            border-radius: 10px;
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

        .swiper-button-next, .swiper-button-prev {
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Outfitly Produk</h1>

    <div class="mb-4">
        <a href="{{ route('cart.index') }}" class="add-btn me-2" style="background-color: green;">Lihat Keranjang</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            768: { slidesPerView: 2, spaceBetween: 15 },
            1024: { slidesPerView: 4, spaceBetween: 20 },
        }
    });

    function toggleFavorite(button, productId) {
        button.classList.toggle('active');
        fetch(`/favorite/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => console.log(data.message));
    }
</script>

</body>
</html>