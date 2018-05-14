<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xem bài viết</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    @foreach($result as $post)
        <div class="card">
            <div class="card-header">{{ $post->updated_time }}</div>
            <div class="card-body">
                <p class="card-text">{{ utf8_decode($post->message) }}</p>
                <a href="https://www.facebook.com/{{ $post->post_id }}" target="_blank" class="btn btn-primary btn-sm">Xem bài viết</a>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
