<div class="col-3">
    <div class="list-group">
        <a href="{{ route('home') }}" class="list-group-item">Home</a>
        <a href="{{ route('photo.index') }}" class="list-group-item">Gallery</a>
    </div>
    <p class="my-2 text-black-50">Manage Posts</p>
    <div class="list-group">
        <a href="{{ route('post.index') }}" class="list-group-item">Post List</a>
        <a href="{{ route('post.create') }}" class="list-group-item">Create Post</a>
    </div>
    <p class="my-2 text-black-50">Manage Category</p>
    <div class="list-group">
        <a href="{{ route("category.index" ) }}" class="list-group-item">Category List</a>
        <a href="{{ route('category.create') }}" class="list-group-item">Create Category</a>
    </div>
    @admin
    <p class="my-2 text-black-50">Manage User</p>
    <div class="list-group">
        <a href="{{ route('user.index') }}" class="list-group-item">User List</a>
    </div>
    @endadmin
</div>
