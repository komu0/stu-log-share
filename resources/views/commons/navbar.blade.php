<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Stu-Log Share</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            @if (Auth::check())
            <li class="nav-item dropdown">
                <li class="nav-item"><a href="#" class="nav-link">ログを投稿</a></li>
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        {{-- ユーザ詳細ページへのリンク --}}
                        <li class="dropdown-item"><a href="#">マイページ</a></li>
                        <li class="dropdown-divider"></li>
                        {{-- ログアウトへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                    </ul>
                </li>
            @else
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">スタログシェアとは？</a></li>
                <li>{!! link_to_route('signup.get', '新規登録(無料)', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item"><a href="#" class="nav-link">ログイン</a></li>
            </ul>
            @endif
        </div>
    </nav>
</header>