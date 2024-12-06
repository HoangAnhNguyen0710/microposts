{{-- コメント部分 --}}
<div class="my-2">
    <button type="button" id="toggle-button-reply-{{ $comment->id }}" class="btn btn-link text-info btn-sm" onclick="toggleReplies({{ $comment->id }}, {{$comment->reply_count()}} )">
        View Replies ({{$comment->reply_count()}})
    </button>
    <div id="replies-{{ $comment->id }}" class="hidden max-h-[200px] overflow-y-auto border py-2 px-4 bg-slate-200">
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="micropost_id" value="{{ $micropost->id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <textarea class="textarea textarea-bordered w-full mb-1" name="content" placeholder="Write a comment..." rows="1"></textarea>
            <button type="submit" class="btn btn-primary btn-sm mb-1">Add Reply</button>
        </form>

        <ul class="list-none">
            @foreach ($comment->get_comment_reply() as $reply) {{-- Assuming this is a relationship --}}
                <li class="border-b pb-2 mb-2 p-2 border-y">
                    <strong>{{ $reply->user->name }}</strong>
                    <span class="text-gray-500 text-sm">{{ $reply->created_at }}</span>
                    <p>{!! nl2br(e($reply->content)) !!}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
                        
<script>
    function toggleReplies(id, count) {
        const commentDiv = document.getElementById(`replies-${id}`);
        const toggleButton = document.getElementById(`toggle-button-reply-${id}`);

        commentDiv.classList.toggle('hidden');
        
        // Update button text based on visibility
        if (commentDiv.classList.contains('hidden')) {
            toggleButton.textContent = `View Replies (${count})`;
        } else {
            toggleButton.textContent = 'Hide Replies';
        }
    }
</script>
