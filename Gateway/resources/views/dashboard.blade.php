<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #2d3748;
            font-weight: 700;
        }

        .user-info {
            text-align: right;
        }

        .user-info h3 {
            color: #4a5568;
            margin-bottom: 5px;
        }

        .user-info p {
            color: #718096;
            font-size: 0.9rem;
        }

        .logout-btn {
            background: #e53e3e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c53030;
            transform: translateY(-2px);
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .service-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .service-icon {
            font-size: 2rem;
            margin-right: 15px;
        }

        .service-title {
            font-size: 1.5rem;
            color: #2d3748;
            font-weight: 600;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: #4299e1;
            color: white;
        }

        .btn-primary:hover {
            background: #3182ce;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #ed8936;
            color: white;
        }

        .btn-secondary:hover {
            background: #dd6b20;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e53e3e;
            color: white;
        }

        .btn-danger:hover {
            background: #c53030;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #38a169;
            color: white;
        }

        .btn-success:hover {
            background: #2f855a;
            transform: translateY(-2px);
        }

        .view-post-modal .modal-content {
            max-width: 800px;
            max-height: 90vh;
        }

        .post-detail {
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .post-detail-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .post-detail-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #718096;
            flex-wrap: wrap;
        }

        .post-detail-body {
            color: #4a5568;
            line-height: 1.7;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .post-detail-stats {
            display: flex;
            gap: 25px;
            margin-bottom: 15px;
        }

        .post-detail-stats .stat {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #718096;
            font-size: 1rem;
            font-weight: 600;
        }

        .comments-section {
            margin-top: 25px;
        }

        .comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .comments-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .comments-count {
            background: #4299e1;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .comment-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 15px;
            border-left: 4px solid #4299e1;
            transition: all 0.2s ease;
        }

        .comment-item:hover {
            transform: translateX(3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .comment-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.85rem;
            color: #718096;
        }

        .comment-author {
            font-weight: 600;
            color: #4a5568;
        }

        .comment-text {
            color: #2d3748;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .no-comments {
            text-align: center;
            padding: 40px 20px;
            color: #718096;
            font-style: italic;
        }

        .comments-loading {
            text-align: center;
            padding: 30px;
            color: #718096;
        }

        .comments-error {
            background: #fed7d7;
            color: #c53030;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .view-post-modal .modal-content {
                width: 95%;
                margin: 10px;
                max-height: 95vh;
            }

            .post-detail-meta {
                flex-direction: column;
                gap: 8px;
            }

            .post-detail-stats {
                flex-direction: column;
                gap: 10px;
            }

            .comments-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        .posts-container,
        .create-post-container,
        .create-comment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: none;
        }

        .posts-container.active,
        .create-post-container.active,
        .create-comment-container.active {
            display: block;
        }

        .post-card {
            background: #f7fafc;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid #4299e1;
            transition: all 0.3s ease;
        }

        .post-card:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .post-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .post-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            font-size: 0.85rem;
            color: #718096;
        }

        .post-body {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .post-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #718096;
            font-size: 0.9rem;
        }

        .post-actions {
            display: flex;
            gap: 10px;
        }

        .comment-card {
            background: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 1.5rem;
            margin-bottom: 1.2rem;
            transition: transform 0.2s;
            border-left: 4px solid #ed8936;
        }

        .comment-card:hover {
            transform: translateY(-2px);
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .comment-body {
            font-size: 1rem;
            color: #333;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .comment-actions {
            display: flex;
            gap: 10px;
        }

        .edit-btn,
        .delete-btn {
            padding: 0.4rem 0.8rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background-color: #f97316;
            color: white;
        }

        .edit-btn:hover {
            background-color: #ea580c;
            transform: translateY(-1px);
        }

        .delete-btn {
            background-color: #ef4444;
            color: white;
        }

        .delete-btn:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }

        .loading,
        .error,
        .no-comments {
            padding: 1rem;
            font-weight: 600;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3748;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #718096;
        }

        .error {
            background: #fed7d7;
            color: #c53030;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .success {
            background: #c6f6d5;
            color: #2f855a;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1000;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #718096;
        }

        .close-btn:hover {
            color: #4a5568;
        }

        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .button-group {
                flex-direction: column;
            }

            .post-meta,
            .post-stats {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>🚀 Dashboard</h1>
                <p>Manage your posts and comments</p>
            </div>
            <div class="user-info">
                <h3>Welcome, {{ session('user')['name'] }}!</h3>
                <p>{{ session('user')['email'] }}</p>
                <p>Token expires: {{ \Carbon\Carbon::parse(session('token_expires_at'))->diffForHumans() }}</p>
                <button class="logout-btn" onclick="logout()">Logout</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-header">
                    <span class="service-icon">📝</span>
                    <h2 class="service-title">Posts Service</h2>
                </div>
                <div class="button-group">
                    <button class="btn btn-primary" onclick="loadPosts()">Load My Posts</button>
                    <button class="btn btn-secondary" onclick="showCreatePost()">Create New Post</button>
                </div>
                <p>Click "Load My Posts" to view your posts</p>
            </div>

            <div class="service-card">
                <div class="service-header">
                    <span class="service-icon">💬</span>
                    <h2 class="service-title">Comments Service</h2>
                </div>
                <div class="button-group">
                    <button class="btn btn-primary" onclick="loadComments()">Load My Comments</button>
                    <button class="btn btn-secondary" onclick="showCreateComment()">Add Comment</button>
                </div>
                <p>Click "Load My Comments" to view your comments</p>
            </div>
        </div>

        <div class="posts-container" id="postsContainer">
            <h2>📝 My Posts</h2>
            <div id="postsContent">
                <div class="loading">Loading posts...</div>
            </div>
        </div>

        <div class="posts-container" id="commentsContainer">
            <h2>💬 My Comments</h2>
            <div id="commentsContent">
                <div class="loading">Loading comments...</div>
            </div>
        </div>

        <div class="create-post-container" id="createPostContainer">
            <h2>✨ Create New Post</h2>
            <form id="createPostForm">
                <div class="form-group">
                    <label class="form-label" for="postTitle">Post Title</label>
                    <input type="text" id="postTitle" class="form-input" placeholder="Enter your post title..."
                        required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="postBody">Post Content</label>
                    <textarea id="postBody" class="form-textarea" placeholder="Write your post content..." required></textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-success">Create Post</button>
                    <button type="button" class="btn btn-secondary" onclick="hideCreatePost()">Cancel</button>
                </div>
            </form>
        </div>

        <div class="create-comment-container" id="createCommentContainer">
            <h2>💬 Add New Comment</h2>
            <form id="createCommentForm">
                <div class="form-group">
                    <label class="form-label" for="commentPostId">Post ID</label>
                    <input type="number" id="commentPostId" class="form-input"
                        placeholder="Enter the post ID to comment on..." required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="commentContent">Comment Content</label>
                    <textarea id="commentContent" class="form-textarea" placeholder="Write your comment..." required></textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-success">Add Comment</button>
                    <button type="button" class="btn btn-secondary" onclick="hideCreateComment()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Post</h3>
                <button class="close-btn" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editPostForm">
                <input type="hidden" id="editPostId">
                <div class="form-group">
                    <label class="form-label" for="editPostTitle">Post Title</label>
                    <input type="text" id="editPostTitle" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="editPostBody">Post Content</label>
                    <textarea id="editPostBody" class="form-textarea" required></textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-success">Update Post</button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Comment Modal -->
    <div class="modal" id="editCommentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Comment</h3>
                <button class="close-btn" onclick="closeEditCommentModal()">&times;</button>
            </div>
            <form id="editCommentForm">
                <input type="hidden" id="editCommentId">
                <div class="form-group">
                    <label class="form-label" for="editCommentPostId">Post ID</label>
                    <input type="number" id="editCommentPostId" class="form-input" required readonly>
                </div>
                <div class="form-group">
                    <label class="form-label" for="editCommentContent">Comment Content</label>
                    <textarea id="editCommentContent" class="form-textarea" required></textarea>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-success">Update Comment</button>
                    <button type="button" class="btn btn-secondary"
                        onclick="closeEditCommentModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- View Post Model --}}
    <div class="modal view-post-modal" id="viewPostModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">📖 Post Details</h3>
                <button class="close-btn" onclick="closeViewPostModal()">&times;</button>
            </div>

            <div id="postDetailContent">
                <div class="loading">Loading post...</div>
            </div>

            <div class="comments-section">
                <div class="comments-header">
                    <h4 class="comments-title">
                        💬 Comments
                        <span class="comments-count" id="commentsCount">0</span>
                    </h4>
                </div>
                <div id="postCommentsContent">
                    <div class="comments-loading">Loading comments...</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // API Configuration
        const API_BASE = '/api/v1';
        const token = '{{ session('access_token') }}';
        const USER_ID = {{ session('user')['id'] ?? 'null' }};

        // Utility function to make API calls
        async function makeAPICall(endpoint, method = 'GET', data = null) {
            try {
                const config = {
                    method,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                };

                if (data && method !== 'GET') {
                    if (data instanceof FormData) {
                        delete config.headers['Content-Type'];
                        config.body = data;
                    } else {
                        config.body = JSON.stringify(data);
                    }
                }

                const response = await fetch(`${API_BASE}${endpoint}`, config);
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.resMsg || `HTTP error! status: ${response.status}`);
                }

                return result;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }

        // Hide all containers
        function hideAllContainers() {
            document.getElementById('postsContainer').classList.remove('active');
            document.getElementById('commentsContainer').classList.remove('active');
            document.getElementById('createPostContainer').classList.remove('active');
            document.getElementById('createCommentContainer').classList.remove('active');
        }

        // Load posts function
        async function loadPosts() {
            const postsContainer = document.getElementById('postsContainer');
            const postsContent = document.getElementById('postsContent');
            const userId = {{ session('user')['id'] ?? 'null' }};

            hideAllContainers();
            postsContainer.classList.add('active');
            postsContent.innerHTML = '<div class="loading">Loading posts...</div>';

            try {
                const result = await makeAPICall(`/post/all/${userId}`);
                const parsed = JSON.parse(result.resMsg);
                if (result.resStatus === 'success' && parsed.data.length > 0) {
                    postsContent.innerHTML = parsed.data.map(post => `
                        <div class="post-card">
                            <div class="post-title">${post.title}</div>
                            <div class="post-meta">
                                <span>📅 ${new Date(post.created_at).toLocaleDateString()}</span>
                                <span>🆔 ${post.id} </span>
                                <span>🏷️ ${post.slug}</span>
                                <span>📊 ${post.status}</span>
                            </div>
                            <div class="post-body">${post.body.substring(0, 200)}${post.body.length > 200 ? '...' : ''}</div>
                            <div class="post-stats">
                                <div class="stat">
                                    <span>❤️</span>
                                    <span>${post.hearts}</span>
                                </div>
                                <div class="stat">
                                    <span>👁️</span>
                                    <span>${post.views}</span>
                                </div>
                            </div>
                            <div class="post-actions">
                                <button class="btn btn-primary" onclick="viewPost(${post.id})">View</button>
                                <button class="btn btn-secondary" onclick="editPost(${post.id})">Edit</button>
                                <button class="btn btn-danger" onclick="deletePost(${post.id})">Delete</button>
                            </div>
                        </div>
                    `).join('');
                } else {
                    postsContent.innerHTML = '<div class="loading">No posts found. Create your first post!</div>';
                }
            } catch (error) {
                postsContent.innerHTML = `<div class="error">Error loading posts: ${error.message}</div>`;
            }
        }

        // Show create post form
        function showCreatePost() {
            hideAllContainers();
            document.getElementById('createPostContainer').classList.add('active');
            document.getElementById('createPostForm').reset();
        }

        // Hide create post form
        function hideCreatePost() {
            hideAllContainers();
        }

        // Create post form submission
        document.getElementById('createPostForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const title = document.getElementById('postTitle').value;
            const body = document.getElementById('postBody').value;

            try {
                const formData = new FormData();
                formData.append('title', title);
                formData.append('body', body);
                formData.append('user_id', USER_ID);

                const result = await makeAPICall('/post', 'POST', formData);

                if (result.resStatus === 'success') {
                    alert('Post created successfully!');
                    hideCreatePost();
                    loadPosts();
                }
            } catch (error) {
                alert(`Error creating post: ${error.message}`);
            }
        });

        // View single post
        async function viewPost(postId) {
            try {
                // Show modal immediately
                document.getElementById('viewPostModal').classList.add('active');
                document.getElementById('postDetailContent').innerHTML = '<div class="loading">Loading post...</div>';
                document.getElementById('postCommentsContent').innerHTML =
                    '<div class="comments-loading">Loading comments...</div>';
                document.getElementById('commentsCount').textContent = '0';

                // Load post details
                const postResult = await makeAPICall(`/post/${postId}`);
                const postParsed = JSON.parse(postResult.resMsg);

                if (postResult.resStatus === 'success') {
                    const post = postParsed.data;
                    document.getElementById('postDetailContent').innerHTML = `
                <div class="post-detail">
                    <h2 class="post-detail-title">${post.title}</h2>
                    <div class="post-detail-meta">
                        <span>📅 ${new Date(post.created_at).toLocaleDateString()}</span>
                        <span>🆔 ID: ${post.id}</span>
                        <span>🏷️ ${post.slug}</span>
                        <span>📊 ${post.status}</span>
                    </div>
                    <div class="post-detail-body">${post.body}</div>
                    <div class="post-detail-stats">
                        <div class="stat">
                            <span>❤️</span>
                            <span>${post.hearts} Hearts</span>
                        </div>
                        <div class="stat">
                            <span>👁️</span>
                            <span>${post.views} Views</span>
                        </div>
                    </div>
                </div>
            `;

                    // Load comments for this post
                    await loadPostComments(postId);
                }
            } catch (error) {
                document.getElementById('postDetailContent').innerHTML = `
            <div class="error">Error loading post: ${error.message}</div>
        `;
                document.getElementById('postCommentsContent').innerHTML = `
            <div class="comments-error">Error loading comments: ${error.message}</div>
        `;
            }
        }

        // Load comments for a specific post
        async function loadPostComments(postId) {
            try {
                const commentsResult = await makeAPICall(`/comment/all/post/${postId}`);
                const commentsParsed = JSON.parse(commentsResult.resMsg);

                if (commentsResult.resStatus === 'success' && commentsParsed.data && commentsParsed.data.length > 0) {
                    const comments = commentsParsed.data;
                    document.getElementById('commentsCount').textContent = comments.length;

                    document.getElementById('postCommentsContent').innerHTML = comments.map(comment => `
                <div class="comment-item">
                    <div class="comment-meta">
                        <span class="comment-author">👤 User ${comment.user_id}</span>
                        <span>📅 ${new Date(comment.created_at).toLocaleDateString()}</span>
                    </div>
                    <div class="comment-text">${comment.contents}</div>
                </div>
            `).join('');
                } else {
                    document.getElementById('commentsCount').textContent = '0';
                    document.getElementById('postCommentsContent').innerHTML = `
                <div class="no-comments">
                    💭 No comments yet. Be the first to comment!
                </div>
            `;
                }
            } catch (error) {
                document.getElementById('commentsCount').textContent = '0';
                document.getElementById('postCommentsContent').innerHTML = `
            <div class="comments-error">Error loading comments: ${error.message}</div>
        `;
            }
        }

        // Close view post modal
        function closeViewPostModal() {
            document.getElementById('viewPostModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('viewPostModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeViewPostModal();
            }
        });

        // Edit post
        async function editPost(postId) {
            try {
                const result = await makeAPICall(`/post/${postId}`);
                const parsed = JSON.parse(result.resMsg);
                if (result.resStatus === 'success') {
                    const post = parsed.data;
                    document.getElementById('editPostId').value = post.id;
                    document.getElementById('editPostTitle').value = post.title;
                    document.getElementById('editPostBody').value = post.body;
                    document.getElementById('editModal').classList.add('active');
                }
            } catch (error) {
                alert(`Error loading post for editing: ${error.message}`);
            }
        }

        // Close edit modal
        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }

        // Edit post form submission
        document.getElementById('editPostForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const postId = document.getElementById('editPostId').value;
            const title = document.getElementById('editPostTitle').value;
            const body = document.getElementById('editPostBody').value;

            try {
                const formData = new FormData();
                formData.append('title', title);
                formData.append('body', body);

                const result = await makeAPICall(`/post/${postId}`, 'POST', formData);

                if (result.resStatus === 'success') {
                    alert('Post updated successfully!');
                    closeEditModal();
                    loadPosts();
                }
            } catch (error) {
                alert(`Error updating post: ${error.message}`);
            }
        });

        // Delete post
        async function deletePost(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                try {
                    const result = await makeAPICall(`/post/${postId}`, 'DELETE');
                    const parsed = JSON.parse(result.resMsg);
                    if (result.resStatus === 'success') {
                        alert('Post deleted successfully!');
                        loadPosts();
                    }
                } catch (error) {
                    alert(`Error deleting post: ${error.message}`);
                }
            }
        }

        // COMMENTS FUNCTIONALITY

        // Load comments function
        async function loadComments() {
            const commentsContainer = document.getElementById('commentsContainer');
            const commentsContent = document.getElementById('commentsContent');

            hideAllContainers();
            commentsContainer.classList.add('active');
            commentsContent.innerHTML = '<div class="loading">Loading comments...</div>';

            try {
                const result = await makeAPICall(`/comment/all/user`);
                const parsed = JSON.parse(result.resMsg);

                if (result.resStatus === 'success' && parsed.data.length > 0) {
                    commentsContent.innerHTML = parsed.data.map(comment => `
                        <div class="comment-card">
                            <div class="comment-header">
                                <div class="comment-date">📅 ${new Date(comment.created_at).toLocaleDateString()}</div>
                                <div class="comment-post-id">🆔 Post ID: ${comment.post_id}</div>
                            </div>
                            <div class="comment-body">
                                ${comment.contents}
                            </div>
                            <div class="comment-actions">
                                <button class="edit-btn" onclick="editComment(${comment.id})">Edit</button>
                                <button class="delete-btn" onclick="deleteComment(${comment.id})">Delete</button>
                            </div>
                        </div>
                    `).join('');
                } else {
                    commentsContent.innerHTML = `<div class="no-comments">No comments available.</div>`;
                }
            } catch (error) {
                console.error('Error in loadComments:', error);
                commentsContent.innerHTML = `<div class="error">Error loading comments: ${error.message}</div>`;
            }
        }

        // Show create comment form
        function showCreateComment() {
            hideAllContainers();
            document.getElementById('createCommentContainer').classList.add('active');
            document.getElementById('createCommentForm').reset();
        }

        // Hide create comment form
        function hideCreateComment() {
            hideAllContainers();
        }

        // Create comment form submission
        document.getElementById('createCommentForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const postId = document.getElementById('commentPostId').value;
            const content = document.getElementById('commentContent').value;

            try {
                const formData = new FormData();
                formData.append('post_id', postId);
                formData.append('contents', content);

                const result = await makeAPICall('/comment', 'POST', formData);

                if (result.resStatus === 'success') {
                    alert('Comment added successfully!');
                    hideCreateComment();
                    loadComments();
                }
            } catch (error) {
                alert(`Error creating comment: ${error.message}`);
            }
        });

        // Edit comment
        async function editComment(commentId) {
            try {
                const result = await makeAPICall(`/comment/${commentId}`);
                const parsed = JSON.parse(result.resMsg);
                if (result.resStatus === 'success') {
                    const comment = parsed.data;
                    document.getElementById('editCommentId').value = comment.id;
                    document.getElementById('editCommentPostId').value = comment.post_id;
                    document.getElementById('editCommentContent').value = comment.contents;
                    document.getElementById('editCommentModal').classList.add('active');
                }
            } catch (error) {
                alert(`Error loading comment for editing: ${error.message}`);
            }
        }

        // Close edit comment modal
        function closeEditCommentModal() {
            document.getElementById('editCommentModal').classList.remove('active');
        }

        // Edit comment form submission
        document.getElementById('editCommentForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const commentId = document.getElementById('editCommentId').value;
            const postId = document.getElementById('editCommentPostId').value;
            const content = document.getElementById('editCommentContent').value;

            try {
                const formData = new FormData();
                formData.append('post_id', postId);
                formData.append('contents', content);

                const result = await makeAPICall(`/comment/${commentId}`, 'POST', formData);

                if (result.resStatus === 'success') {
                    alert('Comment updated successfully!');
                    closeEditCommentModal();
                    loadComments();
                }
            } catch (error) {
                alert(`Error updating comment: ${error.message}`);
            }
        });

        // Delete comment
        async function deleteComment(commentId) {
            if (confirm('Are you sure you want to delete this comment?')) {
                try {
                    const result = await makeAPICall(`/comment/${commentId}`, 'DELETE');
                    const parsed = JSON.parse(result.resMsg);
                    if (result.resStatus === 'success') {
                        alert('Comment deleted successfully!');
                        loadComments();
                    }
                } catch (error) {
                    alert(`Error deleting comment: ${error.message}`);
                }
            }
        }

        // Logout function
        function logout() {
        if (confirm('Are you sure you want to logout?')) {
            document.getElementById('logout-form').submit();
        }
    }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.getElementById('editCommentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditCommentModal();
            }
        });
    </script>
</body>

</html>
