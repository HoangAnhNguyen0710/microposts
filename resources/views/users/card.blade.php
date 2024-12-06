<div class="card border border-base-300 md:max-w-[300px]">
    <figure>
        {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
        @if(!empty($user->avatar))
          <img src="{{ $user->getAvatar() }}" alt="" class="w-[200px] h-[200px]">
        @else
           <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="" class="">
        @endif
    </figure>
    <div class="card-body bg-base-200 text-4xl  md:max-w-[300px]">
        <h2 class="card-title">{{ $user->name }}</h2>
    </div>
       @if (Auth::id() == $user->id)
        <form action="{{ route('users.updateAvatar') }}" method="POST" enctype="multipart/form-data" class="">
            @csrf
            <div class="flex items-center justify-center flex-col">
                <label for="image" class="text-center block w-full font-semibold">Change Avatar</label>
                <input class="my-3" type="file" name="image" id="image" accept="image/*">
                
                <button type="submit" class="btn btn-primary btn-sm my-2">Add</button>
            </div>
    
        </form>
        @endif
</div>
@include('user_follow.follow_button')