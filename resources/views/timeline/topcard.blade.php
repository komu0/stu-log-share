<div class="mb-4">
    <div>
        <h2>
            {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}さん、
            <br class="d-sm-none">
            こんにちは！
        </h2>
        <p><span>フォロー:{!! link_to_route('users.followings', $user->followings_count , ['id' => $user->id]) !!} / </span>
        <span>フォロワー:{!! link_to_route('users.followers', $user->followers_count , ['id' => $user->id]) !!}</span></p>
    </div>
    <div>
        <a href="{{ route('stulogs.create') }}" class="btn btn-primary">ログを投稿</a>
    </div>
</div>
<ul class="nav nav-tabs mb-5">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">みんなのログ</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('timeline') }}" class="nav-link {{ Request::routeIs('timeline') ? 'active' : '' }}">タイムライン</a>
    </li>
</ul>