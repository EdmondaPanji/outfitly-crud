<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $subtotal = $this->calculateSubtotal($cart);

        return view('cart.index', compact('cart', 'subtotal'));
    }

    public function add(Request $request, $id)
    {
        $products = $this->getProducts();
        $product = $products[$id] ?? null;

        if (!$product) {
            return redirect()->route('products.index')->withErrors(['Produk tidak ditemukan!']);
        }

        $cart = session('cart', []);

        $cart[$id] = isset($cart[$id])
            ? array_merge($cart[$id], [
                'quantity' => $cart[$id]['quantity'] + 1,
                'size' => $request->input('size', $cart[$id]['size'] ?? null),
            ])
            : array_merge($product, [
                'quantity' => 1,
                'size' => $request->input('size', null), // Simpan ukuran yang dipilih
            ]);

        session(['cart' => $cart]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan!');
    }

    public function update(Request $request, $id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $quantity = max((int) $request->input('quantity', 1), 1); // Validasi jumlah minimal 1
            $cart[$id]['quantity'] = $quantity;

            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui!');
    }

    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->withErrors(['Keranjang belanja kosong!']);
        }

        $subtotal = $this->calculateSubtotal($cart);

        return view('checkout.index', compact('cart', 'subtotal'));
    }

    public function completeCheckout(Request $request)
    {
        session()->forget('cart');
        return redirect()->route('products.index')->with('success', 'Checkout berhasil! Pesanan Anda telah diproses.');
    }

    public function updateQuantity(Request $request, $id)
{
    $cart = session()->get('cart', []);

    if (!isset($cart[$id])) {
        return response()->json(['error' => 'Item tidak ditemukan'], 404);
    }

    $change = (int) $request->input('quantityChange', 0);
    $cart[$id]['quantity'] += $change;

    // Jangan izinkan quantity < 1
    if ($cart[$id]['quantity'] < 1) {
        unset($cart[$id]);
    } else {
        session()->put('cart', $cart);
    }

    $newSubtotal = collect($cart)->sum(function ($item) {
        return $item['price'] * $item['quantity'];
    });

    return response()->json([
        'newQuantity' => $cart[$id]['quantity'] ?? 0,
        'newSubtotal' => $newSubtotal,
    ]);
}


    /**
     * Hitung total harga keranjang.
     *
     * @param array $cart
     * @return int
     */
    private function calculateSubtotal(array $cart): int
    {
        return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    }

    /**
     * Dapatkan daftar produk.
     *
     * @return array
     */
    private function getProducts(): array
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'Fairy Dust Knit',
                'price' => 180000,
                'image' => 'images/Fairy Dust Knit.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            2 => [
                'id' => 2,
                'name' => 'Flora Sky Blouse',
                'price' => 200000,
                'image' => 'images/Flora Sky Blouse.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            3 => [
                'id' => 3,
                'name' => 'Lavender Charm Polo',
                'price' => 150000,
                'image' => 'images/Lavender Charm Polo.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            4 => [
                'id' => 4,
                'name' => 'Mystic Lavender Shirt',
                'price' => 220000,
                'image' => 'images/Mystic Lavender Shirt.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            5 => [
                'id' => 5,
                'name' => 'Puffy Petal Blouse',
                'price' => 210000,
                'image' => 'images/Puffy Petal Blouse.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            6 => [
                'id' => 6,
                'name' => 'Rosette Charm Blouse',
                'price' => 230000,
                'image' => 'images/Rosette Charm Blouse.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            7 => [
                'id' => 7,
                'name' => 'Sky Bloom Blouse',
                'price' => 190000,
                'image' => 'images/Sky Bloom Blouse.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            8 => [
                'id' => 8,
                'name' => 'Sky Blue Top',
                'price' => 170000,
                'image' => 'images/Sky Blue Top.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
        ];
    }
}