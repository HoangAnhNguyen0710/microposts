<dialog id={{'modal' . $album->id}} class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-0 top-0">✕</button>
        </form>
        <div>
            @include('albums.upload_image')
                @if($album->images())
                <div class="w-[500px] flex flex-wrap">
                    @foreach($album->images() as $image)
                 <div class="relative w-[200px] h-[200px] group">
                    <img src="{{$image->getImageUrl()}}" alt="" class="w-full h-[200px] border-2 border-red-400 rounded-md m-1"/>
                    
                    <button onclick="viewImage('{{$image->getImageUrl()}}')" class="absolute bottom-2 w-full transform opacity-0 group-hover:opacity-100 btn btn-outlined btn-primary btn-md m-1 p-2 rounded-md transition-opacity">
                        View full screen
                    </button>
                </div>
                    @endforeach
                </div>
                @else
                <div class="font-medium text-md">This album has no image, you can try to add some here</div>
                @endif
        </div>
        <script>
            function viewImage(imageUrl) {
                let newTab = window.open(imageUrl, '_blank');
                newTab.focus();
            }
        </script>
  </div>
</dialog>
