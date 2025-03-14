<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    public function toggle($id)
    {
        $favorites = session()->get('favorites', []);
        if (in_array($id, $favorites)) {
            $favorites = array_diff($favorites, [$id]);
        } else {
            $favorites[] = $id;
        }
        session()->put('favorites', $favorites);
        return response()->json(['message' => 'Favorite updated!', 'favorites' => $favorites]);
    }
}


