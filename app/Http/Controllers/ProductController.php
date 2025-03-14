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
            ],
            [
                'id' => 2,
                'name' => 'Flora Sky Blouse',
                'price' => 200000,
                'image' => 'images/Flora Sky Blouse.png',
            ],
            [
                'id' => 3,
                'name' => 'Lavender Charm Polo',
                'price' => 150000,
                'image' => 'images/Lavender Charm Polo.png',
            ],
            [
                'id' => 4,
                'name' => 'Mystic Lavender Shirt',
                'price' => 220000,
                'image' => 'images/Mystic Lavender Shirt.png',
            ],
            [
                'id' => 5,
                'name' => 'Puffy Petal Blouse',
                'price' => 210000,
                'image' => 'images/Puffy Petal Blouse.png',
            ],
            [
                'id' => 6,
                'name' => 'Rosette Charm Blouse',
                'price' => 230000,
                'image' => 'images/Rosette Charm Blouse.png',
            ],
            [
                'id' => 7,
                'name' => 'Sky Bloom Blouse',
                'price' => 190000,
                'image' => 'images/Sky Bloom Blouse.png',
            ],
            [
                'id' => 8,
                'name' => 'Sky Blue Top',
                'price' => 170000,
                'image' => 'images/Sky Blue Top.png',
            ],
        ];

        return view('products.index', compact('products'));
    }
}
