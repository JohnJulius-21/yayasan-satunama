<div class="mb-3 p-3 border rounded">
    <strong>{{ $comment->user->name }}</strong> - <small>{{ $comment->created_at->diffForHumans() }}</small>
    <p>{!! $comment->content !!}</p>

    <!-- Tombol Balas -->
    @auth
        <button class="btn btn-link btn-sm text-success" style="text-decoration: none;" onclick="toggleReplyForm({{ $comment->id_komen }})">Balas</button>
        <form id="reply-form-{{ $comment->id_komen }}" action="{{ route('userKomenStore', $comment->id_diskusi) }}" method="POST" class="d-none mt-2">
            @csrf
            <input type="hidden" name="id_parent" value="{{ $comment->id_komen }}">
            <textarea class="ckeditor form-control" name="content" id="content"></textarea>
            <button type="submit" class="btn btn-success btn-sm mt-2">Kirim</button>
        </form>
    @endauth

    <!-- Menampilkan balasan rekursif -->
    @if ($comment->replies->count())
        <div class="mt-3 ms-4">
            @foreach ($comment->replies as $reply)
                @include('partials.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>

<script>
    function toggleReplyForm(commentId) {
        let form = document.getElementById('reply-form-' + commentId);
        form.classList.toggle('d-none');
    }
</script>
