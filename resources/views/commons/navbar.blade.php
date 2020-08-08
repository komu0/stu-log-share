<header class="mb-4">
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Stu-Log Share</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
            @if (Auth::check())
            <li class="nav-item dropdown">
                <li class="nav-item"><a href="{{ route('stulogs.create') }}" class="nav-link">ログを投稿</a></li>
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->id }}</a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item">{!! link_to_route('users.show', 'マイページ', ['user' => Auth::user()->id]) !!}</li>
                        <li class="dropdown-item">{!! link_to_route('setting', '設定',) !!}</li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">{!! link_to_route('about', 'スタログシェアとは？',) !!}</li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                    </ul>
                </li>
            @else
                <li>{!! link_to_route('about', 'スタログシェアとは？', [], ['class' => 'nav-link']) !!}</li>
                <li>{!! link_to_route('signup.get', '新規登録(無料)', [], ['class' => 'nav-link']) !!}</li>
                <li>{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
            </ul>
            @endif
        </div>
    </nav>
</header>

