<div class="{{ $root ? 'shadow mb-4' : 'border-right-0 border-bottom-0 border-border-left border-top-0 rounded-0 border-secondary' }} card card-body">
  <p>{{ $comment->content }}</p>
  <div class="small">
    <span class="text-muted">by {{ $comment->user->name }}</span>
    -
    <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
      -
    <form action="/comments/{{ $comment->id}}/toggle-like" method="post" class="d-inline-block">
        @csrf
        <button class="bg-transparent border-0 {{ $comment->isLikedByUser() ? 'btn-liked' : 'btn-unliked' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            ({{ $comment->likesCount }})
        </button>
    </form>
    <button onclick="this.parentElement.nextElementSibling.classList.toggle('d-none')" style="align-self: flex-start;" class="bg-transparent border-0 d-inline">
      <svg enable-background="new 0 0 24 24" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m23.25 22c-.27 0-.524-.146-.658-.391l-.021-.038c-2.243-4.051-6.517-6.571-11.153-6.571h-1.418v4.25c0 .301-.181.573-.458.691-.275.116-.599.058-.814-.153l-8.5-8.25c-.146-.141-.228-.335-.228-.538s.082-.397.228-.538l8.5-8.25c.216-.21.539-.27.814-.153.277.118.458.39.458.691v4.252c7.743.134 14 6.474 14 14.248 0 .343-.232.642-.564.727-.062.016-.124.023-.186.023zm-14-8.5h2.168c4.176 0 8.089 1.829 10.764 4.911-1.294-5.669-6.377-9.911-12.432-9.911h-.5c-.414 0-.75-.336-.75-.75v-3.227l-6.673 6.477 6.673 6.477v-3.227c0-.414.336-.75.75-.75z"/></svg>
    </button>
  </div>
  <form action="/posts/{{$comment->post_id}}/comments" method="post" class="d-none">  
    @csrf
    <div class="form-group ml-3">
      <input type="hidden" name="parent_id" value="{{$comment->id}}">
      <label class="text-muted w-100 mb-3">
        <br><textarea type="content" class="form-control d-block" name="content" value="{{ old('content') }}"  placeholder="Enter comment"></textarea>
      </label>
      @error('content')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <button class="btn btn-success">submit</button>
    </div>
  </form>    


  @if (isset($comments[$comment->id]))
    @include('partials.commentsList', ['allComments' => $comments[$comment->id], 'root' => false ])
  @endif

</div>