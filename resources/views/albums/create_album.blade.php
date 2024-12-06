@if (Auth::id() == $user->id)
    <div class="mt-4">
        <form method="POST" action="{{ route('albums.store') }}">
            @csrf
            <div class="form-control mt-4 flex flex-row justify-between max-w-[300px]">
                <textarea name="name" class="input input-bordered w-7/12"></textarea>
                <button type="submit" class="btn btn-primary btn-block normal-case w-1/3">Add</button>
            </div>
        </form>
    </div>
@endif