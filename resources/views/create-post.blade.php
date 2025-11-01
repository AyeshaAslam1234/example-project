<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5 bg-light">
<div class="container">
    <h2 class="mb-4">Create a New Post</h2>

    <form id="postForm">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Body:</label>
            <textarea id="body" name="body" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Post</button>
    </form>

    <div id="message" class="mt-4"></div>

    <hr>
    <h3>All Posts</h3>
    <ul id="postsList"></ul>
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
        console.error(error);
        document.getElementById('postsList').innerHTML =
            '<li class="text-danger">Error loading posts.</li>';
    }
}

// Load posts on page load
loadPosts();

document.getElementById('postForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch('/api/create-post', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            document.getElementById('message').innerHTML =
                '<div class="alert alert-success">Post created successfully!</div>';
            this.reset();
            loadPosts(); // refresh list
        } else {
            document.getElementById('message').innerHTML =
                '<div class="alert alert-danger">Error creating post!</div>';
        }
    } catch (error) {
        document.getElementById('message').innerHTML =
            '<div class="alert alert-danger">Request failed!</div>';
    }
});
</script>
</body>
</html>

 