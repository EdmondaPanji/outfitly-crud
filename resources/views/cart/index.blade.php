@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Keranjang Belanja</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cart as $item)
                <tr>
                    <td><img src="{{ asset($item['image']) }}" width="60" alt="{{ $item['name'] }}"></td>
                    <td>{{ $item['name'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>
                        <form action="{{ route('cart.remove', ['id' => $item['id']]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Keranjang kosong!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if (count($cart) > 0)
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning" onclick="return confirm('Kosongkan keranjang?')">Kosongkan Keranjang</button>
        </form>
    @endif
</div>
@endsection
