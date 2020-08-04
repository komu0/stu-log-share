<div class="mb-4">
  <p>{{ $user->id }}</p>
  <p>followings:{{ $user->followings_count }}</p>
  <p>followers:{{ $user->followers_count }}</p>
  <a href="{{ route('stulogs.create') }}">ログを投稿</a>
</div>