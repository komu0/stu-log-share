<div class="mb-4">
    <p>{!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}</p>
    <p>フォロー:{!! link_to_route('users.followings', $user->followings_count , ['id' => $user->id]) !!}</p>
    <p>フォロワー:{!! link_to_route('users.followers', $user->followers_count , ['id' => $user->id]) !!}</p>
    <a href="{{ route('stulogs.create') }}" class="btn btn-primary">ログを投稿</a>
</div>
<ul class="nav nav-tabs mb-5">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">みんなのログ</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('timeline') }}" class="nav-link {{ Request::routeIs('timeline') ? 'active' : '' }}">タイムライン</a>
    </li>
</ul>