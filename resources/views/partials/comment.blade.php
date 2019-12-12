<div class="card card-body shadow mb-4">
  <p>{{ $comment->content }}</p>
  <div>
    <span class="text-muted">by {{ $post->user->name }}</span>
    -
    <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
      -
    <form action="/comments/{{ $comment->id}}/toggle-like" method="post" class="d-inline-block mr-3">
        @csrf
        <button class="bg-transparent border-0 {{ $comment->isLikedByUser() ? 'btn-liked' : 'btn-unliked' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            ({{ $comment->likesCount }})
        </button>
    </form>
  </div>
</div>