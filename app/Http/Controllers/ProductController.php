<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Fairy Dust Knit',
                'price' => 180000,
                'image' => 'images/Fairy Dust Knit.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'id' => 2,
                'name' => 'Flora Sky Blouse',
                'price' => 200000,
                'image' => 'images/Flora Sky Blouse.png',
                'sizes' => ['S', 'M', 'L'],
            ],
            [
                'id' => 3,
                'name' => 'Lavender Charm Polo',
                'price' => 150000,
                'image' => 'images/Lavender Charm Polo.png',
                'sizes' => ['M', 'L', 'XL'],
            ],
            [
                'id' => 4,
                'name' => 'Mystic Lavender Shirt',
                'price' => 220000,
                'image' => 'images/Mystic Lavender Shirt.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'id' => 5,
                'name' => 'Puffy Petal Blouse',
                'price' => 210000,
                'image' => 'images/Puffy Petal Blouse.png',
                'sizes' => ['S', 'L', 'XL'],
            ],
            [
                'id' => 6,
                'name' => 'Rosette Charm Blouse',
                'price' => 230000,
                'image' => 'images/Rosette Charm Blouse.png',
                'sizes' => ['M', 'L'],
            ],
            [
                'id' => 7,
                'name' => 'Sky Bloom Blouse',
                'price' => 190000,
                'image' => 'images/Sky Bloom Blouse.png',
                'sizes' => ['S', 'M', 'XL'],
            ],
            [
                'id' => 8,
                'name' => 'Sky Blue Top',
                'price' => 170000,
                'image' => 'images/Sky Blue Top.png',
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
        ];

        return view('products.index', compact('products'));
    }
}