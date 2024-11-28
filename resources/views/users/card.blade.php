<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <h2 class="card-title">{{ $user->name }}</h2>
    </div>
    <figure>
        {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
        @if(!empty($user->avatar))
          <img src="{{ $user->getAvatar() }}" alt="">
        @else
           <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="" class="">
        @endif
    </figure>
       @if (Auth::id() == $user->id)
        <form action="{{ route('users.updateAvatar') }}" method="POST" enctype="multipart/form-data" class="">
            @csrf
            <div>
                <label for="image">Upload</label>
                <input class="my-3" type="file" name="image" id="image" accept="image/*">
            </div>
    
            <button type="submit" class="btn btn-primary btn-sm">Add</button>
        </form>
        @endif
</div>
@include('user_follow.follow_button')