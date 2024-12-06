<div class="mt-4">

    @if (isset($microposts))
        <ul class="list-none">
            @foreach ($microposts as $micropost)
                <li class="flex items-start gap-x-2 mb-4">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            @if(!empty($micropost->user()->first()->avatar))
                              <img src="{{$micropost->user()->first()->getAvatar() }}" alt="">
                            @else
                               <img src="{{ Gravatar::get($micropost->user()->first()->email, ['size' => 500]) }}" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="w-full">
                        <div>
                            {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                            <a class="link link-hover text-info" href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
                        </div>
                        <div class="w-full">
                            {{-- 投稿内容 --}}
                            <div class="mb-0 min-h-[150px] max-h-[250px] w-full overflow-y-auto border shadow-blue-500/50 p-3 my-2">{!! $micropost->content !!}</div>
                        </div>
                        <div class="flex">
                            <div class="w-fit mr-1">
                             @include('user_favorite.favorite_button')
                            </div>
                            @if (Auth::id() == $micropost->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm btn-block normal-case text-white rounded-sm my-2" 
                                        onclick="return confirm('Delete id = {{ $micropost->id }} ?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 9l-.867 10.4A2.25 2.25 0 0116.393 21H7.607a2.25 2.25 0 01-2.24-1.6L4.5 9m5.25 0v6m5.25-6v6M10.5 4.5h3M8.25 4.5h7.5m-8.25 0a2.25 2.25 0 012.25-2.25h3a2.25 2.25 0 012.25 2.25m-9.75 0h12" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                            @include('microposts.comment')
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $microposts->links() }}
    @endif
</div>