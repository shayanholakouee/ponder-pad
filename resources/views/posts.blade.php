<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <title>My Blog</title>
</head>
<body>

    <?php foreach ($posts as $post): ?>
        <article>
            <h1>
                <a href="/posts/<?php $post->slug ?>"><?= $post->title ?></a>
            </h1>
            <div>
                <?= $post->excerpt ?>
            </div>
        </article>
    <?php endforeach;?>

</body>
</html>
