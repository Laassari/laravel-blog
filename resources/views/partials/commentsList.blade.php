@foreach ($allComments as $comment)
  @include ('partials.comment', ['root'=> $root])
@endforeach