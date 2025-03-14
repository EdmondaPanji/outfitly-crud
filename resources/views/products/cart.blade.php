<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
            transition: 0.3s;
        }
        .cart-item:hover {
            background-color: #eef6ff;
        }
        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .cart-item-details {
            flex: 1;
        }
        .cart-item-details h3 {
            margin: 0 0 10px 0;
            color: #444;
        }
        .cart-item-details p {
            margin: 5px 0;
        }
        .cart-item-actions {
            display: flex;
            align-items: center;
        }
        .cart-item-actions form button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .cart-item-actions form button:hover {
            background-color: #c0392b;
        }
        .btn {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-danger {
            background-color: #e74c3c;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .empty {
            text-align: center;
            color: #888;
            padding: 50px 0;
            font-size: 1
