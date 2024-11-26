<div class="tabs tabs-lifted">
    {{-- ユーザー詳細タブ --}}
    <a href="{{ route('users.show', $user->id) }}" class="tab grow {{ Request::routeIs('users.show') ? 'tab-active' : '' }}">
        TimeLine
        <div class="badge badge-neutral ml-1">{{ $user->micropostsCount() }}</div>
    </a>
    {{-- フォロー一覧タブ --}}
    <a href="{{ route('users.followings', $user->id) }}" class="tab grow {{ Request::routeIs('users.followings') ? 'tab-active' : '' }}">
        Followings
        <div class="badge badge-neutral ml-1">{{ $user->followingCount() }}</div>
    </a>
    {{-- フォロワー一覧タブ --}}
    <a href="{{ route('users.followers', $user->id) }}" class="tab grow {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">
        Followers
        <div class="badge badge-neutral ml-1">{{ $user->followersCount() }}</div>
    </a>
    <a href="{{ route('user.list_favorites', $user->id) }}" class="tab grow {{ Request::routeIs('user.list_favorites') ? 'tab-active' : '' }}">
        Favorites
        <div class="badge badge-neutral ml-1">{{ $user->favoritesCount() }}</div>
    </a>
</div>