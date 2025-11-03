<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5 bg-light">
<div class="container">
    <h2 class="mb-4">All Posts</h2>
    <ul id="postsList"></ul>

    <a href="{{ route('create.page') }}" class="btn btn-secondary mt-3">Back to Create Post</a>
</div>

<script>
async function loadPosts() {
    try {
        const response = await fetch('/api/posts');
        if (!response.ok) throw new Error('Failed to load posts');
        const posts = await response.json();

        const list = document.getElementById('postsList');
        list.innerHTML = '';

        if (posts.length === 0) {
            list.innerHTML = '<li>No posts found.</li>';
            return;
        }

        posts.forEach(post => {
            list.innerHTML += `
                <li>
                    <strong>${post.title}</strong><br>
                    <small>${post.body ?? ''}</small>
                </li>
                <hr>
            `;
        });
    } catch (error) {
        document.getElementById('postsList').innerHTML =
            '<li class="text-danger">Error loading posts.</li>';
    }
}

// Load posts on page load
loadPosts();
</script>
</body>
</html>
