@extends('layouts.app')

@section('content')
    <h1>Keranjang Belanja</h1>

    @if (count($cart) > 0)
        <ul>
            @foreach ($cart as $id => $item)
                <li>
                    <img src="{{ asset('storage/' . $item['image']) }}" width="100">
                    {{ $item['name'] }} - Rp {{ number_format($item['price'], 0, ',', '.') }} x {{ $item['quantity'] }}
                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button class="btn btn-warning">Kosongkan Keranjang</button>
        </form>
    @else
        <p>Keranjang belanja kosong.</p>
    @endif

    <a href="{{ route('products.index') }}" class="btn btn-primary">← Kembali ke Katalog</a>
@endsection
