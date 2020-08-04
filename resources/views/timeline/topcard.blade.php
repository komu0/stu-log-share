<div class="mb-4">
  <p>{{ $user->id }}</p>
  <p>followings:{{ $user->followings_count }}</p>
  <p>followers:{{ $user->followers_count }}</p>
  <a href="{{ route('stulogs.create') }}">ログを投稿</a>
</div>
<ul class="nav nav-tabs mb-5">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">みんなのログ</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('timeline') }}" class="nav-link {{ Request::routeIs('timeline') ? 'active' : '' }}">タイムライン</a>
    </li>
</ul>