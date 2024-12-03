@if (Auth::id() == $user->id)
    <div class="mt-4">
        <form method="POST" action="{{ route('microposts.store') }}" id="micropost-form">
            @csrf
        
            <div class="form-control mt-4">
                <div id="editor">
                    <!--<p>Create your post!</p>-->
                </div>
                <!-- Hidden input field to store CKEditor content -->
                <input type="hidden" name="content" id="content-input">
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">Post</button>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.umd.js"></script>

    <script>
        const {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } = CKEDITOR;

        let editorInstance;

        ClassicEditor
            .create(document.querySelector('#editor'), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3MzQ0Nzk5OTksImp0aSI6IjQxMTU5MmM5LTc1MGMtNGExZS05MmQ0LWM2M2I1MjMzYTRiOCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjJmMzg4NGFhIn0.TQVfoFif2nNpV1PaLLiF_2PLx3z5zW3jw5M9Izhq20SBU5bF36sBYOKhoExmyMyxuhUGV_giKxhRoyDzF6_TbQ',
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });

        // On form submit, copy the CKEditor content into the hidden input field
        document.getElementById('micropost-form').addEventListener('submit', function(e) {
            const content = editorInstance.getData(); // Get the HTML content from CKEditor
            document.getElementById('content-input').value = content; // Set it in the hidden input field
        });
    </script>
@endif
