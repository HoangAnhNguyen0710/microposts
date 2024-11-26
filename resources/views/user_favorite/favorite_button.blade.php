    @if (Auth::user()->is_favoriting($micropost->id))
        {{-- アンフォローボタンのフォーム --}}
        <form method="POST" action="{{ route('user.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-sm btn-block normal-case text-white rounded-sm my-2" 
                onclick="return confirm('are you sure ?')">Unfavorite</button>
        </form>
    @else
        {{-- フォローボタンのフォーム --}}
        <form method="POST" action="{{ route('user.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-success btn-sm btn-block normal-case text-white rounded-sm my-2">Favorite</button>
        </form>
    @endif
