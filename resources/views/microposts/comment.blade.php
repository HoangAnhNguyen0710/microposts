{{-- コメント部分 --}}
<div class="my-2">
    <button type="button" id="toggle-button-{{ $micropost->id }}" class="btn btn-link text-info btn-sm" onclick="toggleComments({{ $micropost->id }})">
        View Comments ({{$micropost->commentCount()}})
    </button>
    <div id="comments-{{ $micropost->id }}" class="hidden max-h-[200px] overflow-y-auto border p-2">
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="micropost_id" value="{{ $micropost->id }}">
            <textarea class="textarea textarea-bordered w-full mb-1" name="content" placeholder="Write a comment..." rows="1"></textarea>
            <button type="submit" class="btn btn-primary btn-sm mb-1">Add Comment</button>
        </form>

        <ul class="list-none">
            @foreach ($micropost->comments() as $comment) {{-- Assuming this is a relationship --}}
                <li class="border-b pb-2 mb-2 p-2 border-y">
                    <strong>{{ $comment->user->name }}</strong>
                    <span class="text-gray-500 text-sm">{{ $comment->created_at }}</span>
                    <p>{!! nl2br(e($comment->content)) !!}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
                        
<script>
    function toggleComments(id) {
        const commentDiv = document.getElementById(`comments-${id}`);
        const toggleButton = document.getElementById(`toggle-button-${id}`);

        commentDiv.classList.toggle('hidden');
        
        // Update button text based on visibility
        if (commentDiv.classList.contains('hidden')) {
            toggleButton.textContent = 'View Comments';
        } else {
            toggleButton.textContent = 'Hide Comments';
        }
    }
</script>
