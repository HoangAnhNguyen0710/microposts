@if (Auth::id() == $user->id)
    <form action="{{ route('images.upload') }}" method="POST" enctype="multipart/form-data" id="img_upload" class="my-4">
        @csrf
        <div class="flex justify-between">
            <input class="w-7/12" type="file" name="image" id="image" accept="image/*">
            <input class="hidden" name="album_id" value={{$album->id}} />
            <input class="hidden" name="album_name" value={{$album->name}} />
            <button type="submit" class="w-1/4 btn btn-primary btn-sm">Add</button>
        </div>

    </form>
    
@endif