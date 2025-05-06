<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #f5f7fa, #e4e7eb);
            color: #333;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
            font-weight: 700;
            font-size: 2.5rem;
            position: relative;
        }
        h1::after {
            content: "";
            display: block;
            width: 120px;
            height: 3px;
            background-color: #007bff;
            margin: 10px auto;
            border-radius: 2px;
        }
        .container {
            width: 90%;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            transition: 0.3s;
        }
        .cart-item:hover {
            background-color: #eef6ff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .cart-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .cart-item-details {
            flex: 1;
        }
        .cart-item-details h3 {
            margin: 0 0 10px 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #444;
        }
        .cart-item-details p {
            margin: 5px 0;
            color: #666;
            font-size: 1rem;
        }
        .subtotal {
            text-align: right;
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 20px;
            color: #2ecc71;
        }
        .subtotal span {
            color: #007bff;
        }
        .cart-actions {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #e74c3c;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Keranjang Belanja</h1>

    <!-- Tombol Aksi -->
    <div class="cart-actions">
        <a href="/products" class="btn">Kembali ke Katalog</a>
        <form action="/cart/clear" method="POST">
            <button class="btn btn-danger">Kosongkan Keranjang</button>
        </form>
        <a href="/checkout" class="btn">Checkout</a>
    </div>
</div>

</body>
</html>