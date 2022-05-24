<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homepage') }}">First-Auth</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse my_navbar_posts" id="navbarNav">
            <ul class="navbar-nav my_ul_nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.posts.create') }}">Create Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.posts.index') }}">Listing
                        Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{ route('admin.categories.index') }}">Listing
                        Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.myposts') }}">My Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.home') }}">Login Page</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
