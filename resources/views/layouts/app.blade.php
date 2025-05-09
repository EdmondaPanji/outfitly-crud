<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Outfitly')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Konten utama -->
    <main class="flex-fill">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light text-dark py-5 mt-auto border-top">
    <div class="container px-3 px-md-5">
        <div class="row gy-4">
            <!-- Bagian Outfitly -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Outfitly</h5>
                <p class="small mb-3">
                    Outfitly adalah toko fashion yang menawarkan berbagai pilihan pakaian wanita dengan gaya feminin, modern, dan elegan.
                </p>
                <div class="d-flex align-items-center gap-3 mt-3 fs-5">
                    <a href="https://www.facebook.com/fashionweek/" target="_blank" class="text-dark"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/colorbox?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="text-dark"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/0852-1057-6133" target="_blank" class="text-dark"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@kanzeoniiraisyah?_t=ZS-8wCUIgVc9vL&_r=1" target="_blank" class="text-dark"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.youtube.com/@colorbox_id" target="_blank" class="text-dark"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Bagian Company -->
            <div class="col-md-4 d-flex justify-content-center">
                <div>
                <h5 class="fw-bold mb-3">Company</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Tentang Kami</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Koleksi Terbaru</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Galeri</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-dark">Karier</a></li>
                </ul>
                </div>
            </div>

            <!-- Bagian Support -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Support</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2 d-flex align-items-start"><i class="fas fa-map-marker-alt me-2 mt-1 text-muted"></i><span>Jl. Tulip No.57, Jakarta Selatan</span></li>
                    <li class="mb-2 d-flex align-items-start"><i class="fas fa-phone-alt me-2 mt-1 text-muted"></i><span>0852-1057-6133</span></li>
                    <li class="mb-2 d-flex align-items-start"><i class="fas fa-envelope me-2 mt-1 text-muted"></i><span>admin@outfitly.co.id</span></li>
                </ul>
            </div>
        </div>
        <hr class="mt-4">
        <div class="text-center small text-muted pt-2">
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
