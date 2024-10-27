<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Image</title>
</head>
<body>
    <h2>Image Uploaded Successfully!</h2>
    <p>Here is your uploaded image:</p>
    <img src="{{ $url }}" alt="Uploaded Image" style="max-width: 100%; height: auto;">
    <p><a href="{{ route('uploadForm') }}">Upload Another Image</a></p>
</body>
</html>
