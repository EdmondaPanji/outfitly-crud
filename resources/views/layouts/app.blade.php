<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tambah Produk')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body>
    @yield('content')

    <!-- 👇 Footer yang dirapikan -->
    <footer class="bg-light text-dark py-5 px-4 mt-5 border-top">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- Bagian Outfitly -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Outfitly</h5>
                    <p class="small">
                        Outfitly adalah toko fashion daring yang menawarkan berbagai pilihan pakaian wanita dengan gaya feminin, modern, dan elegan.
                    </p>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-5">
                        <a href="#" class="text-dark"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Bagian Company -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Company</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Layanan</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Galeri</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Karier</a></li>
                    </ul>
                </div>

                <!-- Bagian Support -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Support</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Jl. Tulip No.57, Jakarta Selatan</li>
                        <li class="mb-2"><i class="fas fa-phone-alt me-2"></i>0852-1057-6133</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>admin@outfitly.co.id</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4 border-top pt-3 small text-muted">
                © 2025 Outfitly | Dress How You Feel.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/js/app.js'])
    @yield('scripts')
</body>
</html>