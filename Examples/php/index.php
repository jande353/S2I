<?php
// Sample blog posts
$posts = [
    [
        'title' => 'Welcome to My Blog',
        'created_at' => '2025-02-04',
        'content' => 'This is the first post on my blog. Stay tuned for more updates!'
    ],
    [
        'title' => 'Another Blog Post',
        'created_at' => '2025-02-03',
        'content' => 'Here is another blog post with some interesting content.'
    ]
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Page</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .post { border-bottom: 1px solid #ddd; padding: 10px 0; }
        .post h2 { margin: 0; }
        .post p { color: #555; }
    </style>
</head>
<body>
    <h1>Jimmys Blog</h1>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h2><?= htmlspecialchars($post['title']) ?></h2>
            <small>Published on <?= htmlspecialchars($post['created_at']) ?></small>
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
