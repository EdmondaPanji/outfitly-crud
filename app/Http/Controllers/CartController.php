<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add($id)
    {
        $products = [
            1 => [
                'id' => 1,
                'name' => 'Fairy Dust Knit',
                'price' => 180000,
                'image' => 'images/Fairy Dust Knit.png',
            ],
            2 => [
                'id' => 2,
                'name' => 'Flora Sky Blouse',
                'price' => 200000,
                'image' => 'images/Flora Sky Blouse.png',
            ],
            3 => [
                'id' => 3,
                'name' => 'Lavender Charm Polo',
                'price' => 150000,
                'image' => 'images/Lavender Charm Polo.png',
            ],
            4 => [
                'id' => 4,
                'name' => 'Mystic Lavender Shirt',
                'price' => 220000,
                'image' => 'images/Mystic Lavender Shirt.png',
            ],
            5 => [
                'id' => 5,
                'name' => 'Puffy Petal Blouse',
                'price' => 210000,
                'image' => 'images/Puffy Petal Blouse.png',
            ],
            6 => [
                'id' => 6,
                'name' => 'Rosette Charm Blouse',
                'price' => 230000,
                'image' => 'images/Rosette Charm Blouse.png',
            ],
            7 => [
                'id' => 7,
                'name' => 'Sky Bloom Blouse',
                'price' => 190000,
                'image' => 'images/Sky Bloom Blouse.png',
            ],
            8 => [
                'id' => 8,
                'name' => 'Sky Blue Top',
                'price' => 170000,
                'image' => 'images/Sky Blue Top.png',
            ],
        ];

        $product = $products[$id] ?? null;

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan!');
    }
}
