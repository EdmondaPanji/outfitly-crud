<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .image-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Gallery</h1>
        <div class="image-container">
            @foreach($images as $image)
                <div>
                    <img src="{{ asset('images/' . basename($image)) }}" alt="{{ basename($image) }}">
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
