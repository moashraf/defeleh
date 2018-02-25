<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('profiles.index') !!}"><i class="fa fa-edit"></i><span>Profiles</span></a>
</li>

<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{!! route('posts.index') !!}"><i class="fa fa-edit"></i><span>Posts</span></a>
</li>

<li class="{{ Request::is('companycategories*') ? 'active' : '' }}">
    <a href="{!! route('companycategories.index') !!}"><i class="fa fa-edit"></i><span>Companycategories</span></a>
</li>

<li class="{{ Request::is('companies*') ? 'active' : '' }}">
    <a href="{!! route('companies.index') !!}"><i class="fa fa-edit"></i><span>Companies</span></a>
</li>

<li class="{{ Request::is('comments*') ? 'active' : '' }}">
    <a href="{!! route('comments.index') !!}"><i class="fa fa-edit"></i><span>Comments</span></a>
</li>

<li class="{{ Request::is('likes*') ? 'active' : '' }}">
    <a href="{!! route('likes.index') !!}"><i class="fa fa-edit"></i><span>Likes</span></a>
</li>

<li class="{{ Request::is('jobs*') ? 'active' : '' }}">
    <a href="{!! route('jobs.index') !!}"><i class="fa fa-edit"></i><span>Jobs</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('products.index') !!}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>

