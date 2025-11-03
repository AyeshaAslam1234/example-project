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

    <input type="text" id="search" class="form-control mb-3" placeholder="Search posts...">

    <ul id="postsList"></ul>

     <a href="{{ route('create.post') }}" class="btn btn-secondary mt-3">Back to Create Post</a>
</div>

<script>
async function loadPosts(query = '') {
    try {
        const url = query ? `/api/search-posts?query=${encodeURIComponent(query)}` : '/api/posts';
        const response = await fetch(url);
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
        console.error(error);
        document.getElementById('postsList').innerHTML =
            '<li class="text-danger">Error loading posts.</li>';
    }
}

document.getElementById('search').addEventListener('keyup', function() {
    loadPosts(this.value);
});

// Load all posts initially
loadPosts();
</script>

</body>
</html>
